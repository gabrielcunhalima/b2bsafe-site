<x-mail::message>
@if ($voltouContato)
# {{ $lead->nome }} voltou a entrar em contato

Já é um lead **{{ $lead->status->getLabel() }}** desde {{ $lead->created_at?->timezone(config('b2bsafe.fuso_exibicao'))->format('d/m/Y') }}. Novo contato pelo formulário do site sobre **{{ $nomeServico }}**.
@else
# Novo lead pelo formulário do site
@endif

<x-mail::table>
| | |
| :-- | :-- |
| **Nome** | {{ $lead->nome }} |
| **WhatsApp** | {{ $whatsappExibicao }} |
| **E-mail** | {{ $lead->email ?? '—' }} |
| **Serviço** | {{ $nomeServico }} |
| **Canal** | Formulário |
| **Origem** | {{ $lead->origem->canal ?? 'Não identificada' }} |
| **Quando** | {{ $quando }} |
</x-mail::table>

@if ($mensagem)
<x-mail::panel>
"{{ $mensagem }}"
</x-mail::panel>
@endif

<x-mail::button :url="$linkWhatsapp" color="success">
Chamar no WhatsApp
</x-mail::button>

<small>E-mail automático do site B2BSAFE. Contém dados pessoais: não encaminhe fora da equipe.</small>
</x-mail::message>
