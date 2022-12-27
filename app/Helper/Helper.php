<?php 
namespace App\Helper;

use App\Models\Prospect;
use App\Models\Project;
use App\Models\HistoryBlast;
use App\Models\HistoryProspect;
use App\Models\HistorySales;
use App\Models\Pt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Helper
{
    
    public function blastToAgent(Request $request, $NextAgent){
        dd($request->all());
    }
    
    public static function blastToSales($request, $NextAgent, $NextSales){
        // dd($request, $NextAgent, $NextSales);
        // dd($request['nama_prospect']);
        // dd($NextAgent[0]->nama_agent);
        // dd();
        // $helper = new Helper;

        $prospect = Prospect::create([
                        'nama_prospect' => $request['nama_prospect'],
                        'kode_negara' => $request['kode_negara'],
                        'hp' => $request['hp'],
                        'email' => $request['email'],
                        'message' => $request['message'],
                        'status_id' => 1,
                        'status_date' => date(now()),
                        'sumber_data_id' => $request['sumber_data_id'],
                        'sumber_platform_id' => $request['sumber_platform_id'],
                        'campaign_id' => $request['campaign_id'],
                        'role_by' => 1,
                        'utm_source' => $request['utm_source'],
                        'utm_medium' => $request['utm_medium'],
                        'utm_campaign' => $request['utm_campaign'],
                        'full_path_ref' => $request['full_path_ref'],
                    ]);
        
        // dd($prospect->id);

        HistoryBlast::create([
            'prospect_id' => $prospect->id,
            'project_id' => $request['project_id'],
            'agent_id' => $NextAgent[0]->id,
            'sales_id' => $NextSales[0]->id,
            'blast_agent_id' =>  $NextAgent[0]->urut_agent,
            'blast_sales_id' => $NextSales[0]->urut_agent_sales,
        ]);

        $pt = pt::with('user')->where('user_id',Auth::user()->id)->get()[0];
        
        HistoryProspect::create([
            'prospect_id' => $prospect->id,
            'pt_id' => $pt->id,
            'project_id' => $request['project_id'],
            'agent_id' => $NextAgent[0]->id,
            'sales_id' => $NextSales[0]->id,
            'blast_agent_id' => $NextAgent[0]->urut_agent,
            'blast_sales_id' => $NextSales[0]->urut_agent_sales
        ]);

        HistorySales::create([
            'project_id' => $request['project_id'],
            'sales_id' => $NextSales[0]->id,
            'notes' => 'yeay! Kamu menerima Prospect baru, Follow Up sekarang!',
            'subject' => 'Prospect : '.$request['nama_prospect'],
            'history_by' => 'Developer'
        ]);

        $project = Project::find($request['project_id']);

        $destination = '62'.substr($NextSales[0]->user->hp,1);
        $message = "Hallo ".strtoupper($NextSales[0]->nama_sales)." Anda telah menerima database baru an. ".$request['nama_prospect']." untuk project $project->nama_project. Harap segera Follow Up database tersebut. \n\nKlik link dibawah ini untuk login :\nhttps://sales-beta.makutapro.id";

        // Helper::SendWA($destination, $message);

        return "Data berhasil di tambahkan.";

        // FCM
        // $this->pushNotif($NextSales[0]->UsernameKP, $kodeproject, $namaprospect);
        // $this->pushNotifKotlin($NextSales[0]->UsernameKP, $kodeproject, $namaprospect);
    }

    public static function SendWA($destination, $message){
        $my_apikey = "ZJFOVG1W5TTL3OEPVEQK";
        $api_url = "http://panel.rapiwha.com/send_message.php";
        $api_url .= "?apikey=". urlencode ($my_apikey);
        $api_url .= "&number=". urlencode ($destination);
        $api_url .= "&text=". urlencode ($message);
        $my_result_object = json_decode(file_get_contents($api_url, false));
    }

    public static function PushNotif($UsernameKP, $title, $body){
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = DB::table('TokenFCM')
            ->select('TokenFCM')
            ->where('id', DB::raw("(select max(`id`) from TokenFCM where `UsernameKP` = '$UsernameKP')"))
            ->get();
        if(count($FcmToken) > 0){
            $serverKey = 'AAAA8QlsNCY:APA91bFXmxrGz5CMJxxXF_AzREaaHu4h6fW7zZv5I1T565gTSxPcEZJ1S3UgvQZkS4EmssM5IF9LkXViaBguvivjSxTxGdgNXWmbLvVJ6K2-NjNGFEIwheeEgBKjveZLrXs-Un4A255H';

            $data = [
                "registration_ids" => [$FcmToken[0]->TokenFCM],
                "notification" => [
                    "title" => $title,
                    "body" => $body,
                ]
            ];
            $encodedData = json_encode($data);
  
            $headers = [
                'Authorization:key=' . $serverKey,
                'Content-Type: application/json',
            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

            // Execute post
            $result = curl_exec($ch);

            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }

            // Close connection
            curl_close($ch);
        }
    }
}