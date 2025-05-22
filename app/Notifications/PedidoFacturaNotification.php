<?php

namespace App\Notifications;

use App\Models\Pedido;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PedidoFacturaNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Pedido $pedido;

    public function __construct(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $lineaProductos = '';
        foreach ($this->pedido->productos as $producto) {
            $lineaProductos .= "- {$producto->nombre} x{$producto->pivot->cantidad} = €" . number_format($producto->pivot->precio_total, 2) . "\n";
        }

        return (new MailMessage)
            ->subject('Confirmación de Pedido y Factura Digital')
            ->greeting("Hola {$notifiable->name},")
            ->line('Gracias por tu pedido. Aquí tienes el resumen de tu compra:')
            ->line($lineaProductos)
            ->line("Subtotal: €" . number_format($this->pedido->subtotal, 2))
            ->line("IGIC: €" . number_format($this->pedido->subtotal * 0.07, 2))
            ->line("Total: €" . number_format($this->pedido->total, 2))
            ->line('Tu pedido ha sido recibido y está en proceso.')
            ->salutation('Gracias por tu compra, ¡hasta pronto!');
    }
}
