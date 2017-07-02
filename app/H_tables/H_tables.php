<?php

namespace App\H_tables;


trait H_tables
{

    public function h_datatable(){
        $row = array();
        $output = array(

            "aaData" => array()
        );


        $blogs = Blog::all();


        foreach($blogs as $blog){

            $row[]=$blog->title;
            $row[] =$blog->description;

            $output['aaData'][] = $row;
            $row = array();
        }


        // echo json_encode( $output );// Comment this line


        return response()->json($output, 200);

    }

}