# 🧠 ViaCEP Hardcore

[![Tests](https://github.com/yzpeedro/viacep-hardcore/actions/workflows/run-tests.yml/badge.svg)](https://github.com/yzpeedro/viacep-hardcore/actions)
[![Latest Version](https://img.shields.io/packagist/v/yzpeedro/viacep-hardcore.svg?style=flat-square)](https://packagist.org/packages/yzpeedro/viacep-hardcore)
[![License](https://img.shields.io/github/license/yzpeedro/viacep-hardcore.svg?style=flat-square)](LICENSE)

Uma biblioteca **hardcore** e moderna em php para consumir a api [ViaCEP](https://viacep.com.br), com tipagem forte, validações e foco em testes.

---

## 🚀 Instalação

```bash
composer require yzpeedro/viacep-hardcore
```

## 🧩 Uso básico

```php
use Yzpeedro\ViaCepHardcore\ViaCep;

$viaCep = new ViaCep('12345678'); // substitua pelo CEP desejado
$response = $viaCep->completeResponseObject();

echo $response->data->cep; // 12345678
echo $response->data->logradouro; // Rua Exemplo
echo $response->data->bairro; // Bairro Exemplo
```

## ✅ Recursos

- Suporte completo ao retorno da api ViaCEP
- Integração com Guzzle
- Validações e exceptions específicas
- Cobertura de testes com PHPUnit
- Análise Estática com PHPStan
- Fixer PSR12 configurado

## 🧪 Testando localmente
Para rodar os testes localmente, você precisa ter o [Composer](https://getcomposer.org/) instalado. Após isso, execute os seguintes comandos:

```bash
composer install
composer test
```

> isso executa: php-cs-fixer (formatação), phpstan (análise estática), phpunit (testes)

## 📦 autoload

```json
{
  "autoload": {
    "psr-4": {
      "Yzpeedro\\ViacepHardcore\\": "src/"
    }
  }
}
```

## 🤝 contribuindo
Sinta-se à vontade para abrir issues ou pull requests. Sugestões são bem-vindas!


## 🎯 Conclusão 

Esse pacote nasceu como um exercício técnico e uma pequena provocação sobre **over engineering** — porque, sejamos honestos: consultar o ViaCEP poderia ser feito com uma simples chamada `file_get_contents()` e um `json_decode()`,
a ideia aqui foi levar essa tarefa trivial ao extremo, aplicando **boas práticas**, **tipagem forte**, **validações rigorosas**, **testes**, **exceptions específicas**, **autoloader organizado**, **ci**, entre outros detalhes.
Mas atenção: **não recomendo esse nível de complexidade para problemas simples no seu dia a dia**. o objetivo deste pacote é **didático**, não prescritivo.
Se ele for útil para você — ótimo! Ele está pronto para produção e pode ser usado com tranquilidade.  
Mas, acima de tudo, espero que ele te inspire a pensar sobre **quando vale a pena aplicar engenharia mais elaborada... e quando não vale**.
Contribuições e reflexões são sempre bem-vindas 🙌
