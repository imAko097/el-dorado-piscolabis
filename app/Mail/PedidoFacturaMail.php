<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Pedido;

class PedidoFacturaMail extends Mailable
{
    use Queueable, SerializesModels;

    public Pedido $pedido;

    public function __construct(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }

    public function build()
    {
        return $this->subject('Factura de tu pedido #' . $this->pedido->id)
                    ->markdown('emails.factura')
                    ->with([
                        'pedido' => $this->pedido,
                        'usuario' => $this->pedido->usuario,
                        'productos' => $this->pedido->productos,
                    ]);
    }
}

