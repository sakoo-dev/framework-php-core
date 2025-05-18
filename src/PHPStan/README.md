# Development Roadmap

Useful Links to Inspiring new PHPStan Rules, for Zero-Dependency Approach

## Security

- [Semgrep](https://github.com/semgrep/semgrep) to check common dependencies vulnerability and security issues
- [Gitleaks](https://github.com/gitleaks/gitleaks) to prevent push secret keys on a public place
- [SonarQube](https://rules.sonarsource.com/php) to find common vulnerabilities and security issues
- GitHub Dependabot to upgrade and find vulnerabilities of dependencies

## Code & Architecture

- [Arkitect](https://github.com/phparkitect/arkitect) to test architectural style of the project
- [SonarQube](https://rules.sonarsource.com/php) to find code smells and bugs

## Dependencies

- Dependency Checking (Injection, Inversion)

## Testable Code

- Don't make instance in functions and constructors

## Copied from makefile

```
Should run make prepare => doc:gen
Sonar Qube + CI
run secret key checking
run dependency checking
run dockerfile security check (docker scout recommendations $DOCKER_IMAGE / docker scout cves $DOCKER_IMAGE)
endpoint healthcheck (/dev/healthcheck/)
```