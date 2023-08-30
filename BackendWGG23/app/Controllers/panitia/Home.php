<?php

namespace App\Controllers\Panitia;

use App\Controllers\BaseController;
use App\Models\PanitiaModel;
use App\Models\RBAC\RBACUserRoleModel;
use App\Helpers\ApiHelper;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\RequestInterface;


class Home extends BaseController
{
    private function getRoute(){

        $userRoleModel = new RBACUserRoleModel();
        $routes = $userRoleModel
            ->select("rbac_route.nama as nama_route, rbac_route.route as route")
            ->join("rbac_role", "rbac_user_role.id_role = rbac_role.id")
            ->join("rbac_role_route", "rbac_user_role.id_role = rbac_role_route.id_role")
            ->join("rbac_route", "rbac_role_route.id_route = rbac_route.id")
            ->where("rbac_user_role.deleted_at IS NULL")
            ->where("rbac_role_route.deleted_at IS NULL")
            ->groupStart()
                ->where("user", session()->get("nrp"))
                ->orWhere("user", session()->get("divisi"))
            ->groupEnd()
            ->orderBy("rbac_route.nama")
            ->findAll();

        //sort berdasarkan jumlah / dari terkecil ke besar
        usort($routes,function($a,$b){
            $jumA = preg_match_all("//",$a['route']);
            $jumB = preg_match_all("//",$b['route']);
            return $jumA <=> $jumB;
        });
            
        //hasil akhir
        $rute = [];
            
        $jumAwalRoutes = count($routes);
        for ($i=0; $i < $jumAwalRoutes; $i++) { 
            if(!array_key_exists($i, $routes)){  //check
                continue;
            }
            array_push($rute, $routes[$i]);
            $route = $routes[$i];
            for ($j=0; $j < $jumAwalRoutes; $j++) { 
                if(!array_key_exists($j, $routes)){
                    continue;
                }
                $regex = $routes[$j];
                // d($rute);
                // d($routes);
                // d($route['route'] . ' ' . $regex['route']);
                if(preg_match('~'.$route['route'].'.*~', $regex['route']) >= 1){
                    unset($routes[$j]);
                }
            }   
        }

        //sort berdasarkan nama
        usort($rute,function($a,$b){
            return $a <=> $b;
        });

        return $rute;
    }
    public function index()
    {
        $rute = $this->getRoute();
        return view('panitia/panitia_home',['rute' => $rute]);
    }
}
