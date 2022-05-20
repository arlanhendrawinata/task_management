<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Division;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class GlobalSearchController extends Controller
{
    public function search(Request $request)
    {
        $projects = Project::select('id', 'judul_project AS item')->where('judul_project', 'LIKE', '%' . $request->q . '%')->get()->toArray();
        $Eprojects = Project::select('id', 'judul_project AS item')->where('judul_project', 'LIKE', '%' . $request->q . '%')->exists();

        $users = User::select('id', 'nama AS item')->where('nama', 'LIKE', '%' . $request->q . '%')->get()->toArray();
        $Eusers = User::select('id', 'nama AS item')->where('nama', 'LIKE', '%' . $request->q . '%')->exists();

        $divisions = Division::select('id', 'nama_divisi AS item')->where('nama_divisi', 'LIKE', '%' . $request->q . '%')->get()->toArray();
        $Edivisions = Division::select('id', 'nama_divisi AS item')->where('nama_divisi', 'LIKE', '%' . $request->q . '%')->exists();

        $clients = Client::select('id', 'nama_client AS item')->where('nama_client', 'LIKE', '%' . $request->q . '%')->get()->toArray();
        $Eclients = Client::select('id', 'nama_client AS item')->where('nama_client', 'LIKE', '%' . $request->q . '%')->exists();
        // $countprojects = Project::select('id', 'judul_project')->where('judul_project', 'LIKE', '%' . $request->q . '%')->count();
        $projects = array(
            'type' => 'Projects',
            'items' => $projects
        );

        $users = array(
            'type' => 'Users',
            'items' => $users
        );

        $divisions = array(
            'type' => 'Divisions',
            'items' => $divisions
        );

        $clients = array(
            'type' => 'Clients',
            'items' => $clients
        );


        $all = [$Eprojects ? $projects : '', $Eusers ? $users : '', $Edivisions ? $divisions : '', $Eclients ? $clients : ''];
        $all = array_merge(array_filter($all));

        $countAll = count($all);

        for ($i = 0; $i < $countAll; $i++) {
            $project_items[] = [
                'text' => $all[$i]['type'],
            ];

            for ($j = 0; $j < count($all[$i]['items']); $j++) {

                $project_items[$i]['children'][] =  [
                    'id' => $all[$i]['items'][$j]['id'],
                    'text' => $all[$i]['items'][$j]['item'],
                    'type' => $all[$i]['type'],
                ];
            }
        }
        // echo '<pre>';
        // print_r($all);
        // // echo json_encode($project_items, JSON_PRETTY_PRINT);
        // echo '</pre>';

        return response()->json($project_items);
    }
}
