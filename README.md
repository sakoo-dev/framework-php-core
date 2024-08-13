<h1>
<picture>
  <source media="(prefers-color-scheme: dark)" srcset=".github/static/logo-dark.png">
  <source media="(prefers-color-scheme: light)" srcset=".github/static/logo-light.png">
  <img width="96" src=".github/static/logo-light.png">
</picture>
Sakoo PHP Web Framework (Core)
</h1>

![GitHub License](https://img.shields.io/github/license/sakoo-dev/framework-php-core)
![Static Badge](https://img.shields.io/badge/Status-In_Development-green)
[![Visitor](https://visitor-badge.laobi.icu/badge?page_id=sakoo-dev/framework-php-core)](https://github.com/sakoo-dev/framework-php-core)

![GitHub Tag](https://img.shields.io/github/v/tag/sakoo-dev/framework-php-core)
![Packagist Version](https://img.shields.io/packagist/v/sakoo/framework-core)

![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/sakoo-dev/framework-php-core/ci.yml)
![Coverage Badge](https://img.shields.io/endpoint?url=https://gist.githubusercontent.com/pouyaaofficial/ebfe01b7208b0dc6ee0f0302795bd2ee/raw/framework-php-core_main.json)

![GitHub Release Date](https://img.shields.io/github/release-date/sakoo-dev/framework-php-core)
![GitHub Downloads (all assets, all releases)](https://img.shields.io/github/downloads/sakoo-dev/framework-php-core/total)

<a href="https://sakoo.dev" target="_blank">
    <img src=".github/static/undraw-sakoo.svg" width="400"/>
</a>

## :rocket: A Platform for Soaring

> [!WARNING]
>
> **This Project is Under Construction**
>
>It's not a Stable and Reliable Version. Please do not use it in Production Environment.

## Requirements

Sakoo Just needed _Docker_ Platform to Run.
Make sure [___Docker___ and ___Docker Compose___](https://docker.com) are installed on your system.
___Windows users___ could use the _Windows Subsystem for Linux (WSL-2)_ to Run the Project on _Docker Desktop_.
See [Windows WSL-2 Installation Guide.](https://docs.microsoft.com/en-us/windows/wsl/install)

## Installation (Build)

Run the following command to initialize the Project:

```bash
make
```

Once after the Project initialization, you can use following commands:

```bash
make up     # equals to docker-compose up -d
make down   # equals to docker-compose down
make rm     # removes the all containers and theirs persist data
```

Sakoo uses a ___Docker Proxy___ Program, and it gives you ability to interact with your favorite tools, Easily.
For Example:

```bash
./sakoo php <your command>
./sakoo composer <your command>
./sakoo test
```

## Contributing

Thank you for considering contributing to the Sakoo framework! You can read our contribution guidelines [Here](.github/CONTRIBUTION.md).

## Code of Conduct

In order to ensure that the Sakoo community is welcoming to all, please review and abide by the [Code of Conduct](.github/CODE_OF_CONDUCT.md).

## Security Vulnerabilities

If you discover a security vulnerability within Sakoo, please send an email to [**Pouya Asgharnejad Tehran**](mailto:pouyaaofficial@gmail.com).
All security vulnerabilities will be promptly addressed. You can read this complete [Security Policy Guide](./SECURITY.md).

## License

The **Sakoo PHP Framework** is open-source software licensed under the [MIT License](LICENSE.md).