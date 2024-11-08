<?php

namespace App\Exceptions;

use Exception;

class NoEntityDefined extends Exception
{
    /**
     * Constructor de la excepción.
     *
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message = "No entity defined", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Reportar o registrar la excepción.
     *
     * @return void
     */
    public function report()
    {
        // Puedes agregar lógica para reportar la excepción, como enviar un correo electrónico o registrar en un log
    }

    /**
     * Renderizar la excepción en una respuesta HTTP.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json([
            'error' => 'No entity defined'
        ], 400);
    }
}
