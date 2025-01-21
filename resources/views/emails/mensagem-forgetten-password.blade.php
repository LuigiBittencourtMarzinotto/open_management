<x-mail::message>
# Olá, tudo bem?

Faça a atualização da sua senha!

Clique neste **[link]({{$link}})** para **redefinir a sua senha de login** no app {{ config('app.name') }} com sua conta {{ $email }}.

Se você não solicitou a redefinição da sua senha, ignore este e-mail.
Contamos com sua ajuda!.
Abraços,<br>
{{ config('app.name') }}
</x-mail::message>
