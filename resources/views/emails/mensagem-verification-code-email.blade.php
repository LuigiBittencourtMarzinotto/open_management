<x-mail::message>
# Olá, {{ $name }}

Seu código do gerenciador financeiro **{{ config('app.name') }}** chegou!

Ao copiá-lo, volte à página de acesso e insira o código abaixo para confirmar sua identidade.

## Seu código de acesso é:
# **{{ $code }}**

Lembrando que essa etapa é muito importante para mantermos a segurança dos seus dados e cumprirmos nosso compromisso com você.

Se você não solicitou o código, não o utilize e ignore.

Abraços,<br>
{{ config('app.name') }}
</x-mail::message>
