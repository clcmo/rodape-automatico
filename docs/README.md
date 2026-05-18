# Rodapé Automático – Footer Copyright

[![GitHub license](https://img.shields.io/github/license/clcmo/footer_copyright?style=for-the-badge)](https://github.com/clcmo/footer_copyright/blob/main/LICENSE)
[![GitHub stars](https://img.shields.io/github/stars/clcmo/footer_copyright?style=for-the-badge)](https://github.com/clcmo/footer_copyright/stargazers)
[![GitHub issues](https://img.shields.io/github/issues/clcmo/footer_copyright?style=for-the-badge)](https://github.com/clcmo/footer_copyright/issues)
[![GitHub donate](https://img.shields.io/github/sponsors/clcmo?color=pink&style=for-the-badge)](https://github.com/sponsors/clcmo)
[![Apoie](https://img.shields.io/github/sponsors/clcmo?color=pink&style=for-the-badge)](https://github.com/sponsors/clcmo)

Plugin WordPress que exibe automaticamente o ano atual e o texto de copyright no rodapé, personalizado conforme o tipo de site.

---

## ✨ Funcionalidades

- Shortcode `[meu_copyright]` para usar em qualquer lugar do site
- Atualização automática do ano (sem precisar editar manualmente)
- Painel de configurações em **Configurações → Rodapé Copyright**
- Quatro modos de copyright conforme o perfil do site:

| Tipo | Texto gerado |
|------|-------------|
| **Geral** | © 2025. Nome do Site. Todos os direitos reservados. |
| **Educativo** | © 2025. Nome do Site. Conteúdo de caráter exclusivamente educativo. Todos os direitos reservados. |
| **Sem fins lucrativos** | © 2025. Nome do Site. Este site não possui finalidades lucrativas. Todos os direitos reservados. |
| **Creative Commons** | Nome do Site — Licenciado sob Creative Commons BY 4.0 *(com ícone opcional)* |

- Para os modos **Creative Commons**: escolha a licença (BY, BY-SA, BY-ND, BY-NC, BY-NC-SA, BY-NC-ND), a versão (4.0, 3.0, 2.5) e se deseja exibir o ícone oficial da CC
- Campo de texto adicional para os modos Educativo e Sem fins lucrativos (nome da instituição, registro, etc.)
- CSS mínimo não-intrusivo, sobrescrito pelo tema normalmente

---

## 🚀 Instalação

### Via painel do WordPress
1. Acesse **Plugins → Adicionar novo**
2. Pesquise por **Rodapé Automático Footer Copyright**
3. Clique em **Instalar** e depois **Ativar**

### Via upload manual
1. Faça o download do arquivo `.zip` na aba [Releases](https://github.com/clcmo/footer_copyright/releases)
2. Acesse **Plugins → Adicionar novo → Enviar plugin**
3. Selecione o `.zip` e clique em **Instalar agora**, depois **Ativar**

### Via FTP / cPanel
1. Descompacte o `.zip`
2. Envie a pasta `footer-copyright` para `wp-content/plugins/`
3. Ative o plugin em **Plugins → Plugins instalados**

---

## ⚙️ Configuração

Após ativar, acesse **Configurações → Rodapé Copyright** e escolha:

1. **Tipo de site** — Geral, Educativo, Sem fins lucrativos ou Creative Commons
2. **Texto adicional** *(Educativo / Sem fins lucrativos)* — informação extra após o aviso principal
3. **Licença CC** *(Creative Commons)* — tipo e versão da licença
4. **Ícone CC** *(Creative Commons)* — exibir ou não o selo visual

A pré-visualização ao final da página mostra exatamente como o shortcode será renderizado.

---

## 🔖 Uso do shortcode

Cole em qualquer página, post, widget de texto ou diretamente no template do tema:

```
[meu_copyright]
```

**Exemplo de saída (modo Geral):**
```
© 2025. Meu Site. Todos os direitos reservados.
```

**Exemplo de saída (modo Creative Commons BY 4.0):**
```
Meu Site — Licenciado sob Creative Commons BY 4.0 [ícone]
```

---

## 🖼️ Capturas de tela

1. Painel de configurações — seleção do tipo de site
2. Opções Creative Commons expandidas
3. Exemplo de rodapé no frontend

---

## 📋 Requisitos

- WordPress 5.0 ou superior
- PHP 7.4 ou superior

---

## 🤝 Contribuindo

Contribuições são bem-vindas! Para contribuir:

1. Faça um fork do repositório
2. Crie uma branch: `git checkout -b minha-feature`
3. Commit suas alterações: `git commit -m 'feat: minha feature'`
4. Push para a branch: `git push origin minha-feature`
5. Abra um Pull Request

Consulte o arquivo [CONTRIBUTING.md](docs/CONTRIBUTING.md) para mais detalhes.

---

## 📄 Licença

Este plugin é distribuído sob a licença **GPL-2.0-or-later**.  
Consulte o arquivo [LICENSE](LICENSE) para mais detalhes.

> Este programa é software livre; você pode redistribuí-lo e/ou modificá-lo sob os termos da Licença Pública Geral GNU conforme publicada pela Free Software Foundation; na versão 2 da Licença, ou (a seu critério) qualquer versão posterior.

---

## 👩‍💻 Autora

**Camila Leite**  
🌐 [camilaoliveira.com/dev](https://go.camilaloliveira.com/dev)  