<table cellpadding="0" cellspacing="0" style="margin: 0px; padding:0px; width:700px; border:none !important; border-collapse:collapse; font-size:13px; font-family:Arial, Helvetica, sans-serif;">
    <tbody>
    <tr style="padding: 0px 15px 0px 0px;">
        <td>
            <table style="font-family: arial; font-size: 11px; text-align: right; color: #7c7c7c;">
                <tr>
                    <td style="border-bottom: solid 2px #0459a3; padding-bottom: 25px; width: 700px; text-align: left;">
                        <h1> SOFTECA </h1>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="height: 30px;"></td>
    </tr>
        @yield('content')

    <tr>
        <td style="height: 50px;"></td>
    </tr>
    <tr>
        <td>
            <table style="border-top: solid 1px #cacaca;">
                <tr>
                    <td style="height: 12px;"></td>
                </tr>
                <tr style="color: #00957e; font-family: Verdana; font-size: 11px; ">
                    <td>{{__('Antes de imprimir este correo electrónico piense bien si es necesario hacerlo: Nuestros bosques se lo agradecerán')}} </td>
                </tr>
                <tr style="color: #888888; font-family: arial; font-size: 10px;">
                    <td>
                        {{__('Este mensaje se dirige exclusivamente a su destinatario y puede contener información privilegiada o confidencial. Si no es vd. el destinatario indicado, queda notificado de que la utilización, divulgación y/o copia sin autorización está prohibida en virtud de la legislación vigente. Si ha recibido este mensaje por error, le rogamos que nos lo comunique inmediatamente por esta misma vía y proceda a su destrucción.')}}
                    </td>
                </tr>
                <tr>
                    <td style="height: 15px;"></td>
                </tr>
                <tr style="color: #888888; font-family: arial; font-size: 10px;">
                    <td>
                        This message is intended exclusively for its addressee and may contain information that is CONFIDENTIAL and protected by professional privilege. If you are not the intended recipient you are hereby notified that any dissemination, copy or disclosure of this communication is strictly prohibited by law. If this message has been received in error, please immediately notify us via e-mail and delete it.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    </tbody>
</table>
