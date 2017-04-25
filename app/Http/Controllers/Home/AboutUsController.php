<?php

namespace App\Http\Controllers\Home;

use App\Aboutus;
use App\Model\Advert;
use App\Model\Announcement;
use App\Model\Friendlylink;
use App\Model\Newtype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;

class AboutUsController extends Controller
{

    //进入关于我们的信息页面
    public function index()
    {
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
        $friendlylink = Friendlylink::paginate(2);
        // 分类列表信息
        $newtype = Newtype::pluck('description');
        $results['collect'] = $results['collect']->toArray();
        $results['favtimes'] = $results['favtimes']->toArray();
        $announcement = Announcement::where('status',1)->value('description');

        $result = Aboutus::all()->first();
        return view('home.aboutUs',compact('news'),['mycollect'=>$results['collect'],'myfavtimes'=>$results['favtimes'],'newtype'=>$newtype,'city'=>$city,'friendlylink'=>$friendlylink,'advert'=>$advert,'announcement'=>$announcement,'result'=>$result ]);
    }


    //进行数据更新切换操作
    public function update()
    {
       $result[]=Aboutus::first()->$_GET['a'];

       return json_encode($result);
    }

}
