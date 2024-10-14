<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait HandleCustomResponse
{
    public function handleError(\Throwable $th) : Response
    {
        
        if(config('app.debug')){
            $data = [
                "message" => $th->getMessage(),
                "trace"   => $th->getTrace()
            ];
            return response($data,Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
        return response(__('messages.request.failed'));
    }

    public function studentNotFound($idStudent) : Response
    {
        return response(__('messages.student.notfound',["id" => $idStudent]),Response::HTTP_NOT_FOUND);
    }

    public function responseAttemptUpdateStudent(bool $resultUpdateStudent) : Response
    {

        if($resultUpdateStudent){
            return response(__('messages.student.actionSuccess',['action'=>'updated']));
        }

        return response(__('messages.student.actionError',['action'=>'update']));
    }

    public function responseAttemptDeleteStudent(bool $resultUpdateStudent) : Response
    {

        if($resultUpdateStudent){
            return response(__('messages.student.actionSuccess',['action'=>'deleted']));
        }

        return response(__('messages.student.actionError',['action'=>'delete']));
    }
}
