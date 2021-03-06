<?php

namespace App\Http\Controllers\Home;

use App\UserFans;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Vinkla\Hashids\Facades\Hashids;
use App\Model\Newtype;
use App\Model\Friendlylink;
use App\Model\Advert;
use App\Model\Announcement;
class LoginHomeController extends Controller
{

  // 显示首页内容
    public function index()
    {
      // 天气接口
      $url = 'http://v.juhe.cn/weather/index?format=1&cityname=上海市&key=331aec2bd696e59ded0915a9f344e9f0';
      $data = null;
      // curl 初始化
      $curl = curl_init();

      // curl 设置
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);  // 查看ssl 证书节点
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);  // 查看ssl 证书主机
      // 判断有没有 data 如果有data 我们就是post
      if ( !empty($data) ) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
      }
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

      // 执行
      $res1 = curl_exec($curl);
      $aaa=json_decode($res1,true);
      $weather=($aaa['result']['today']);

        // 城市
        $url = 'https://api.map.baidu.com/location/ip?ak=w5L0aToOkWnLAvs6vrz43ETDunLS2wTl&coor=bd09ll';
        $data=null;
        // curl 初始化
        $curl = curl_init();

        // curl 设置
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);  // 查看ssl 证书节点
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);  // 查看ssl 证书主机
        // 判断有没有 data 如果有data 我们就是post
        if ( !empty($data) ) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        // 执行
        $res = curl_exec($curl);
        $city=json_decode($res,true)['content']['address'];

        $id = Cookie::get('UserId');
        $news = DB::table('news')->where('status','=','1')->skip(0)->take(10)->orderBy('id', 'desc')->get();
        foreach ($news as $new ) {
          $new->username = DB::table('homeuser')->where('id','=',$new->uid)->value('name');
          $new->usericon = DB::table('homeuserinfo')->where('uid','=',$new->uid)->value('icon');
          $new->countcom = DB::table('comment')->where('mid','=',$new->id)->count();
          $new->images = DB::table('photoes')->where('mid',$new->id)->orderBy('id')->pluck('PhotosUrl');
          $new->uid = Hashids::encode($new->uid);
          $new->hid = Hashids::encode($new->id);
          $new->bid = Hashids::encode($id);
          if ( $new->transmits !== -1 ) {
            $tra = DB::table('news')->where('id',$new->transmits)->get();
            $new->traname = DB::table('homeuser')->where('id','=',$tra[0]->uid)->value('name');
            $new->traimages = DB::table('photoes')->where('mid',$tra[0]->id)->orderBy('id')->pluck('PhotosUrl');
            $new->trauid = Hashids::encode($tra[0]->uid);
            $new->tracon = $tra[0]->content;
          }
        }
        // 用户是否收藏
        $collectdb = DB::table('user_collect');
        $favtimesdb = DB::table('user_favtimes');

        $results['collect'] = $collectdb->where('user_id','=',$id)->paginate(10)->pluck('collect_id');
        $results['favtimes'] = $favtimesdb->where('user_id','=',$id)->paginate(10)->pluck('favtimes_id');
        foreach($results as $result){
          for ($i=0; $i < count($result); $i++) {
            $result[$i] = Hashids::encode($result[$i]);
          }
        }

        $advert = Advert::all();
        $friendlylink = Friendlylink::paginate(10);
        // 分类列表信息
        $newtype = Newtype::pluck('description');
        $results['collect'] = $results['collect']->toArray();
        $results['favtimes'] = $results['favtimes']->toArray();
        $announcement = Announcement::where('status',1)->value('description');

        return view('home.index',compact('news'),['mycollect'=>$results['collect'],'myfavtimes'=>$results['favtimes'],'newtype'=>$newtype,'city'=>$city,'friendlylink'=>$friendlylink,'advert'=>$advert,'announcement'=>$announcement,'weather'=>$weather ]);
    }

//    登陆
    public  function doLogin(Request $request)
  {
//      验证 用户名 密码 激活 不存在则验证 手机 不存在则验证 邮箱
//      即 用于验证用户名 或 手机 或 邮箱 登陆
      $loginUser = DB::table('homeuser')
          ->where('password',md5($request->password))
          ->where('is_confirmed','1')
          ->where('name',$request->username)->get();
      if (!sizeof($loginUser)){
          $loginUser = DB::table('homeuser')
              ->where('password',md5($request->password))
              ->where('is_confirmed','1')
              ->where('phone',$request->username)->get();
      }
      if (!sizeof($loginUser)){
          $loginUser = DB::table('homeuser')
              ->where('password',md5($request->password))
              ->where('is_confirmed','1')
              ->where('email',$request->username)->get();
      }
//      判断是否有数据   有 则返回数据  没有  则登陆失败
      if (!sizeof($loginUser)){
         echo false;
         exit;
      }
        Cookie::queue('UserId',$loginUser[0]->id,0);
        Cookie::queue('UserNickname', $loginUser[0]->name,0);
      $loginUser = json_encode($loginUser);
      echo $loginUser;
  }



//    退出登录
      public function doLogout(){
          Cookie::queue('UserId','',-1);
          Cookie::queue('UserNickname','',-1);
          return redirect('/home/index');
      }

      //存储注册信息
      public function store(Request $request)
      {
          $userem = DB::table('homeuser')->where('email',$request->input('email'))->get();
          $userna = DB::table('homeuser')->where('name',$request->input('nickname'))->get();
          if(sizeof($userna)){
//              有数据
              $errors = '用户名已存在';
              return view('/home/index',compact('errors'));
          }
          if(sizeof($userem)){
//              有数据
              $errors = '邮箱已存在';
              return view('/home/index',compact('errors'));
          }

          $arr = array();
          $confirmed_code = str_random(24);
          $data = [
              'confirmed_code' =>$confirmed_code,
              'create_time' => time()
          ];
          foreach ($request->all() as $k => $v){
              if ($k == '_token' || $k == 'password_confirmation'){
                  continue;
              }
              if ($k == 'nickname'){
                  $arr['name'] = $v;
                  continue;
              }
              if ($k == 'password'){
                  $arr[$k] = md5($v);
                  continue;
              }
              $arr[$k] = $v;
          }
          DB::table('homeuser')->insert(array_merge($arr,$data));
          $user = DB::table('homeuser')->orderBy('id','desc')->limit(1)->get()[0];
          DB::table('homeuserinfo')->insert(['uid'=>$user->id]);
          DB::table('level')->insert(['uid'=>$user->id]);
          $view = 'home.emailConfirmed';
          $subject = '请验证邮箱';
          $this->sendEmail($user,$view, $subject, $data);
          return redirect('/home/register');
      }
      //发送邮件
      public function sendEmail($user, $view, $subject, $data)
      {
          Mail::send($view, $data, function ($m) use ($subject,$user) {
              $m->to($user->email)->subject($subject);
          });
      }
      //查询与之匹配的这个用户
      public function emailConfirm($code)
      {
          $user = DB::table('homeuser')->where('confirmed_code', $code);
          if (is_null($user)) {
              return redirect('home/index');
          }
          DB::update('update homeuser set confirmed_code="aa",is_confirmed=1 where confirmed_code=?',[$code]);
          return redirect('/home/registersuccess');
      }
















}
