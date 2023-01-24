<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Prospect;
use App\Models\HistoryProspect;
use App\Models\HistoryChangeStatus;
use App\Models\Historysales;
use App\Models\RemindStatus;
use Illuminate\Support\Facades\DB;
use App\Helper\Helper;

class ChangeStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for Status prospect and move according to the specified time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $prospect_new = Prospect::get_leads_by_status(1);
        $prospect_cold = Prospect::get_leads_by_status(2);
        $prospect_warm = Prospect::get_leads_by_status(3);
        $prospect_hot = Prospect::get_leads_by_status(4);

        for ($i=0; $i < count($prospect_new); $i++) { 
            $to_time = strtotime(now());
            $from_time = strtotime($$prospect_new[$i]->move_date);
            $diffTime = round(abs($to_time - $from_time) / 60,2);

            if ($diffTime > 1440) {
                
            }
        }

        for ($i=0; $i < count($prospect_cold); $i++) { 

            $NamaProspect = strtoupper($prospect_cold[$i]->NamaProspect);
            $NamaProject = strtoupper($prospect_cold[$i]->NamaProject);
            $destination = '62'.substr($prospect_cold[$i]->Hp,1);
            $title = 'Reminder !';
            $ProspectID = $prospect_cold[$i]->ProspectID;

            $status_remind = RemindStatus::where('ProspectID',$prospect_cold[$i]->ProspectID)
                                ->where('KodeSales',$prospect_cold[$i]->KodeSales)
                                ->get();

                                
            $FuDate = DB::table('Fu')
                        ->where('FuID',DB::raw("(select max(`FuID`) from Fu where `ProspectID` = '$ProspectID')"))
                        ->get()[0]->FuDate;

            if(count($status_remind) == 0){
                RemindStatus::create([
                    'KodeSales' => $prospect_cold[$i]->KodeSales,
                    'ProspectID' => $prospect_cold[$i]->ProspectID
                ]);
            }

            $status_remind = RemindStatus::where('ProspectID',$prospect_cold[$i]->ProspectID)
                        ->where('KodeSales',$prospect_cold[$i]->KodeSales)
                        ->select('*',DB::raw('MAX(id) as id'))
                        ->get()[0];
            

            if(round(abs(strtotime(now()) - strtotime($FuDate)) / 60, 2) > 1440 && !$status_remind->ColdDay2){
                
                $body = "Hallo, Data ini sudah hari ke-2 belum berubah status. Harap segera update status konsumen an. $NamaProspect untuk Project $NamaProject jika sudah ada progress.";
                
                // Helper::SendWA($destination, $body);
                Helper::PushNotif($prospect_cold[$i]->UsernameKP, $title, $body);

                historysales::create([
                    'KodeSales'=> $prospect_cold[$i]->KodeSales,
                    'Notes' => $body,
                    'Subject' => $title,
                    'KodeProject' => $prospect_cold[$i]->KodeProject,
                    'HistoryBy' => 'Developer'
                ]);

                $status_remind->ColdDay2 = true;
                $status_remind->save();

            }

            if(round(abs(strtotime(now()) - strtotime($FuDate)) / 60, 2) > 2880 && !$status_remind->ColdDay3){
                
                $body = "Apakah Anda sudah follow up konsumen atas nama $NamaProspect untuk Project $NamaProject  yang berstatus COLD, agar mengetahui Promo dan Keunggulan Produk?";

                // Helper::SendWA($destination, $body);

                Helper::PushNotif($prospect_cold[$i]->UsernameKP, $title, $body);

                historysales::create([
                    'KodeSales'=> $prospect_cold[$i]->KodeSales,
                    'Notes' => $body,
                    'Subject' => $title,
                    'KodeProject' => $prospect_cold[$i]->KodeProject,
                    'HistoryBy' => 'Developer'
                ]);

                $status_remind->ColdDay3 = true;
                $status_remind->save();

            }

            if($status_remind->ColdDay3 && round(abs(strtotime(now()) - strtotime($FuDate)) / 60, 2) > 2880){
                historyprospect::where(['ProspectID'=>$prospect_cold[$i]->ProspectID])->update([
                    'NotInterestedDate' => date('Y-m-d H:i:s')
                ]);
                Prospect::where(['ProspectID' => $prospect_cold[$i]->ProspectID])->update([
                    'EditBy' => 'system',
                    'Status' => 'Not Interested',
                    'StatusDate' => date('Y-m-d H:i:s'),
                    'NotInterestedID' => 10,
                ]);
                historychangestatus::create([
                    'UsernameKP' => $prospect_cold[$i]->UsernameKP, //sales
                    'ProspectID' => $prospect_cold[$i]->ProspectID,
                    'Status' => 'Not Interested',
                    'StandardID' => 10,
                    'LevelInputID' => 'system'
                ]);
            }

        }

        for ($i=0; $i < count($prospect_warm); $i++) { 
            
            $NamaProspect = strtoupper($prospect_warm[$i]->NamaProspect);
            $NamaProject = strtoupper($prospect_warm[$i]->NamaProject);
            $destination = '62'.substr($prospect_warm[$i]->Hp,1);
            $title = 'Reminder !';
            $body = "Apakah Anda sudah follow up konsumen atas nama $NamaProspect untuk Project $NamaProject  yang berstatus WARM, agar dapat mengundang ke Marketing Gallery ?";

            $status_remind = RemindStatus::where('ProspectID',$prospect_warm[$i]->ProspectID)
                                            ->where('KodeSales',$prospect_warm[$i]->KodeSales)
                                            ->get();

            if(count($status_remind) == 0){
                RemindStatus::create([
                    'KodeSales' => $prospect_warm[$i]->KodeSales,
                    'ProspectID' => $prospect_warm[$i]->ProspectID
                ]);
            }
            
            $status_remind = RemindStatus::where('ProspectID',$prospect_warm[$i]->ProspectID)
                                            ->where('KodeSales',$prospect_warm[$i]->KodeSales)
                                            ->select('*',DB::raw('MAX(id) as id'))
                                            ->get()[0];

            // dd($status_remind);

            if(round(abs(strtotime(now()) - strtotime($prospect_warm[$i]->StatusDate)) / 60, 2) > 5760 && !$status_remind->WarmDay5){
                // dd('warmday5');

                // Helper::SendWA($destination, $body);

                Helper::PushNotif($prospect_warm[$i]->UsernameKP, $title, $body);

                historysales::create([
                    'KodeSales'=> $prospect_warm[$i]->KodeSales,
                    'Notes' => $body,
                    'Subject' => $title,
                    'KodeProject' => $prospect_warm[$i]->KodeProject,
                    'HistoryBy' => 'Developer'
                ]);

                $status_remind->WarmDay5 = true;
                $status_remind->save();

            }

            if(round(abs(strtotime(now()) - strtotime($prospect_warm[$i]->StatusDate)) / 60, 2) > 12960 && !$status_remind->WarmDay10){
                // dd('warmday10');
                // Helper::SendWA($destination, $body);

                Helper::PushNotif($prospect_warm[$i]->UsernameKP, $title, $body);

                historysales::create([
                    'KodeSales'=> $prospect_warm[$i]->KodeSales,
                    'Notes' => $body,
                    'Subject' => $title,
                    'KodeProject' => $prospect_warm[$i]->KodeProject,
                    'HistoryBy' => 'Developer'
                ]);

                $status_remind->WarmDay10 = true;
                $status_remind->save();
            }

            if(round(abs(strtotime(now()) - strtotime($prospect_warm[$i]->StatusDate)) / 60, 2) > 20160 && !$status_remind->WarmDay15){
                // dd('warmday15');
                // Helper::SendWA($destination, $body);

                Helper::PushNotif($prospect_warm[$i]->UsernameKP, $title, $body);

                historysales::create([
                    'KodeSales'=> $prospect_warm[$i]->KodeSales,
                    'Notes' => $body,
                    'Subject' => $title,
                    'KodeProject' => $prospect_warm[$i]->KodeProject,
                    'HistoryBy' => 'Developer'
                ]);

                $status_remind->WarmDay15 = true;
                $status_remind->save();

            }

            if(round(abs(strtotime(now()) - strtotime($prospect_warm[$i]->StatusDate)) / 60, 2) > 25920 && !$status_remind->WarmDay19){
                // dd('warmday19');
                $body = "Apakah Anda sudah follow up konsumen atas nama $NamaProspect untuk Project $NamaProject ? Dikarenakan Sudah 14 hari berstatus WARM. untuk menghindari status berubah menjadi Not Interested secara otomatis";

                // Helper::SendWA($destination, $body);

                Helper::PushNotif($prospect_warm[$i]->UsernameKP, $title, $body);

                historysales::create([
                    'KodeSales'=> $prospect_warm[$i]->KodeSales,
                    'Notes' => $body,
                    'Subject' => $title,
                    'KodeProject' => $prospect_warm[$i]->KodeProject,
                    'HistoryBy' => 'Developer'
                ]);

                $status_remind->WarmDay19 = true;
                $status_remind->save();
                
            }

            if ($status_remind->WarmDay19) {
                // dd("move");
                historyprospect::where(['ProspectID'=>$prospect_warm[$i]->ProspectID])->update([
                    'NotInterestedDate' => date('Y-m-d H:i:s')
                ]);

                Prospect::where(['ProspectID' => $prospect_warm[$i]->ProspectID])->update([
                    'EditBy' => 'system',
                    'Status' => 'Not Interested',
                    'StatusDate' => date('Y-m-d H:i:s'),
                    'NotInterestedID' => 11,
                ]);

                historychangestatus::create([
                    'UsernameKP' => $prospect_warm[$i]->UsernameKP,
                    'ProspectID' => $prospect_warm[$i]->ProspectID,
                    'Status' => 'Not Interested',
                    'StandardID' => 11,
                    'LevelInputID' => 'system'
                ]);
            }

        }

        for($i=0; $i<count($prospect_hot); $i++){

            $NamaProspect = strtoupper($prospect_hot[$i]->NamaProspect);
            $NamaProject = strtoupper($prospect_hot[$i]->NamaProject);
            $destination = '62'.substr($prospect_hot[$i]->Hp,1);
            $title = 'Reminder !';
            $body = "Apakah anda sudah follow up hot prospect atas nama $NamaProspect untuk closing?";

            $status_remind = RemindStatus::where('ProspectID',$prospect_hot[$i]->ProspectID)
                                            ->where('KodeSales',$prospect_hot[$i]->KodeSales)
                                            ->get();

            // dd($status_remind);
            if(count($status_remind) == 0){
                RemindStatus::create([
                    'KodeSales' => $prospect_hot[$i]->KodeSales,
                    'ProspectID' => $prospect_hot[$i]->ProspectID
                ]);
            }
            
            $status_remind = RemindStatus::where('ProspectID',$prospect_hot[$i]->ProspectID)
                                            ->where('KodeSales',$prospect_hot[$i]->KodeSales)
                                            ->select('*',DB::raw('MAX(id) as id'))
                                            ->get()[0];

            // dd($status_remind);

            if(round(abs(strtotime(now()) - strtotime($prospect_hot[$i]->StatusDate)) / 60, 2) > 5760 && !$status_remind->HotDay5){
                // dd('hotday5');

                // Helper::SendWA($destination, $body);

                Helper::PushNotif($prospect_hot[$i]->UsernameKP, $title, $body);

                historysales::create([
                    'KodeSales'=> $prospect_hot[$i]->KodeSales,
                    'Notes' => $body,
                    'Subject' => $title,
                    'KodeProject' => $prospect_hot[$i]->KodeProject,
                    'HistoryBy' => 'Developer'
                ]);

                $status_remind->HotDay5 = true;
                $status_remind->save();

            }

            if(round(abs(strtotime(now()) - strtotime($prospect_hot[$i]->StatusDate)) / 60, 2) > 12960 && !$status_remind->HotDay10){
                // dd('hotday10');
                // Helper::SendWA($destination, $body);

                Helper::PushNotif($prospect_hot[$i]->UsernameKP, $title, $body);

                historysales::create([
                    'KodeSales'=> $prospect_hot[$i]->KodeSales,
                    'Notes' => $body,
                    'Subject' => $title,
                    'KodeProject' => $prospect_hot[$i]->KodeProject,
                    'HistoryBy' => 'Developer'
                ]);

                $status_remind->HotDay10 = true;
                $status_remind->save();
            }

            if(round(abs(strtotime(now()) - strtotime($prospect_hot[$i]->StatusDate)) / 60, 2) > 20160 && !$status_remind->HotDay15){
                // dd('hotday15');
                // Helper::SendWA($destination, $body);

                Helper::PushNotif($prospect_hot[$i]->UsernameKP, $title, $body);

                historysales::create([
                    'KodeSales'=> $prospect_hot[$i]->KodeSales,
                    'Notes' => $body,
                    'Subject' => $title,
                    'KodeProject' => $prospect_hot[$i]->KodeProject,
                    'HistoryBy' => 'Developer'
                ]);

                $status_remind->HotDay15 = true;
                $status_remind->save();

            }

            if(round(abs(strtotime(now()) - strtotime($prospect_hot[$i]->StatusDate)) / 60, 2) > 25920 && !$status_remind->HotDay19){
                // dd('hotday19');

                // Helper::SendWA($destination, $body);

                Helper::PushNotif($prospect_hot[$i]->UsernameKP, $title, $body);

                historysales::create([
                    'KodeSales'=> $prospect_hot[$i]->KodeSales,
                    'Notes' => $body,
                    'Subject' => $title,
                    'KodeProject' => $prospect_hot[$i]->KodeProject,
                    'HistoryBy' => 'Developer'
                ]);

                $status_remind->HotDay19 = true;
                $status_remind->save();
                
            }

            if($status_remind->HotDay19){
                historyprospect::where(['ProspectID'=>$prospect_hot[$i]->ProspectID])->update([
                    'NotInterestedDate' => date('Y-m-d H:i:s')
                ]);

                Prospect::where(['ProspectID' => $prospect_hot[$i]->ProspectID])->update([
                    'EditBy' => 'system',
                    'Status' => 'Not Interested',
                    'StatusDate' => date('Y-m-d H:i:s'),
                    'NotInterestedID' => 12,
                ]);

                historychangestatus::create([
                    'UsernameKP' => $prospect_hot[$i]->UsernameKP,
                    'ProspectID' => $prospect_hot[$i]->ProspectID,
                    'Status' => 'Not Interested',
                    'StandardID' => 12,
                    'LevelInputID' => 'system'
                ]);
            }
        }

        $this->info('Successfully Check Status Prospect');
    }
}
