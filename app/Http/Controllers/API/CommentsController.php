<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\CommentsResource;
use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends BaseController
{

    public function index()
    {
        $comments = Comments::all();
        return $this->sendResponse(CommentsResource::collection($comments), 'Comentarios Recuperados Correctamente.');
    }

    public function store(Request $request)
    {
        $comments = new Comments();
        $comments->date = $request->input('date');
        $comments->comment = $request->input('comment');
        $comments->user_id = $request->input('user_id');
        $comments->process_id = $request->input('process_id');
        $comments->save();
        return $this->sendResponse(new CommentsResource($comments), 'Comentario Creado Correctamente.');
    }

    public function show($id)
    {
        $comments = Comments::find($id);

        if (is_null($comments)) {
            return $this->sendError('Comentario no encontrado.');
        }

        return $this->sendResponse(new CommentsResource($comments), 'Comentarios recuperados correctamente.');
    }

    public function update(Request $request, $id)
    {
        $comments = Comments::find($id);
        $comments->date = $request->input('date');
        $comments->comment = $request->input('comment');
        $comments->user_id = $request->input('user_id');
        $comments->process_id = $request->input('process_id');
        $comments->save();
        return $this->sendResponse(new CommentsResource($comments), 'Comentarios actualizados con éxito.');
    }

    public function destroy($id)
    {
        $comments = Comments::find($id);
        $comments->delete();
        return $this->sendResponse([], 'Comentarios eliminados con éxito');
    }

    public function processcomment($id)
    {

        $data = Comments::leftJoin('process', 'process.id', '=', 'comments.process_id')
            ->select('comments.*', 'process.name as process_name')
            ->where('comments.process_id', $id)
            ->orderBy('comments.id', 'DESC')
            ->get();

        if (is_null($data)) {
            return $this->sendError('Comentario no encontrado.');
        }
        return $this->sendResponse(CommentsResource::collection($data), 'Comentarios recuperados correctamente.');

    }
}
