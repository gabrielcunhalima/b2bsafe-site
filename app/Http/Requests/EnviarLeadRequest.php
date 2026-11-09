<?php

namespace App\Http\Requests;

use App\Rules\WhatsAppBrasileiro;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Formulário de lead (RF-006): campos obrigatórios da RN-001, telefone da RN-002 e aceite da RN-011.
 * O campo "site" é a armadilha para robôs (honeypot, RN-016).
 */
class EnviarLeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'min:2', 'max:120'],
            'whatsapp' => ['required', 'string', 'max:30', new WhatsAppBrasileiro],
            'email' => ['required', 'string', 'email:rfc', 'max:190'],
            'servico' => ['required', 'string', Rule::in(array_keys(config('b2bsafe.servicos')))],
            'mensagem' => ['nullable', 'string', 'max:1000'],
            'aceite' => ['accepted'],
            'site' => ['nullable', 'string', 'max:255'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'nome.required' => 'Informe seu nome.',
            'nome.min' => 'Informe seu nome completo.',
            'whatsapp.required' => 'Informe seu WhatsApp com DDD.',
            'email.required' => 'Informe seu e-mail.',
            'email.email' => 'Informe um e-mail válido, por exemplo voce@empresa.com.br.',
            'servico.required' => 'Escolha o serviço de interesse.',
            'servico.in' => 'Escolha um dos serviços da lista.',
            'mensagem.max' => 'A mensagem pode ter até 1.000 caracteres.',
            'aceite.accepted' => 'Para enviar, aceite a Política de Privacidade.',
        ];
    }

    /** @return array<string, string> */
    public function attributes(): array
    {
        return ['nome' => 'nome', 'whatsapp' => 'WhatsApp', 'email' => 'e-mail', 'servico' => 'serviço', 'mensagem' => 'mensagem'];
    }

    public function ehRobo(): bool
    {
        return filled($this->input('site'));
    }

    /** @return array{nome: string, whatsapp: string, email: string, servico: string, mensagem: ?string} */
    public function dadosLead(): array
    {
        return [
            'nome' => (string) $this->validated('nome'),
            'whatsapp' => (string) $this->validated('whatsapp'),
            'email' => (string) $this->validated('email'),
            'servico' => (string) $this->validated('servico'),
            'mensagem' => $this->validated('mensagem'),
        ];
    }
}
