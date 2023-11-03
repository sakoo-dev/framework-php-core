<h1>
<picture>
  <source media="(prefers-color-scheme: dark)" srcset=".github/static/logo-dark.png">
  <source media="(prefers-color-scheme: light)" srcset=".github/static/logo-light.png">
  <img width="96" src=".github/static/logo-light.png">
</picture>
Sakoo PHP Web Framework (Core)
</h1>
<img src=".github/static/undraw-sakoo.svg" width="400"/>

## :rocket: A Platform for Soaring

> [!WARNING]
>
> **This Project is Under Construction**
>
>It's not a Stable and Reliable Version. Please do not use it in Production Environment.

## Development Plan
- [x] Core utility components (Oct 2023)
- [ ] Routing, Request and Response, Middlewares, Controllers (Nov 2023)
- [ ] Template Engine, Google Chrome Plugin (Dec 2023)
- [ ] Database Connection, ORM (Jan 2024)
- [ ] Release LTS Version 1.0.0 (March 2024)

## Requirements
Sakoo Just needed _Docker_ Platform to Run.
Make sure [___Docker___ and ___Docker Compose___](https://docker.com) are installed on your system.
___Windows users___ could use the _Windows Subsystem for Linux (WSL-2)_ to Run the Project on _Docker Desktop_.
See [Windows WSL-2 Installation Guide.](https://docs.microsoft.com/en-us/windows/wsl/install)

## Installation

Run the following command to initialize the Project: 
```bash
make init
```
Once after the Project initialization, you can use following commands:
```bash
make up     # equals to docker-compose up -d
make down   # equals to docker-compose down
make rm     # removes the container's persist data
```
Sakoo uses a ___Docker Proxy___ Program, and it gives you ability to interact with your favorite tools, Easily.
For Example:
```bash
./sakoo php <your command>
./sakoo composer <your command>
./sakoo test
```

## Contributing
Thank you for considering contributing to the Sakoo framework! You can read our contribution guidelines [Here](.github/CONTRIBUTION.md)

## Code of Conduct
In order to ensure that the Sakoo community is welcoming to all, please review and abide by the [Code of Conduct](.github/CODE_OF_CONDUCT.md)

## Security Vulnerabilities
If you discover a security vulnerability within Sakoo, please send an email to [**Pouya Asgharnejad Tehran**](mailto:pouyaaofficial@gmail.com).
All security vulnerabilities will be promptly addressed. You can read this complete [Security Policy Guide](./SECURITY.md).

## License
The **Sakoo PHP Framework** is open-source software licensed under the [MIT License](LICENSE.md).