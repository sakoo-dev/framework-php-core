# Contribution

Thank you for considering contributing to the Sakoo PHP Web Framework (Core)! We welcome contributions that align with our core values and help us improve the framework. This document outlines the process for contributing code, reporting issues, and participating in our community.

## Table of Contents

1. [Code of Conduct](#code-of-conduct)
2. [Getting Started](#getting-started)
3. [Coding Style](#coding-style)
4. [Making Changes](#making-changes)
5. [Submitting a Pull Request](#submitting-a-pull-request)
6. [CI Pipeline](#ci-pipeline)
7. [Reporting Issues](#reporting-issues)
8. [Learning and Support](#learning-and-support)

## Code of Conduct

Before contributing, please read and adhere to our [Code of Conduct](CODE_OF_CONDUCT.md). We believe in fostering a respectful and inclusive environment. Remember that readability, simplicity, and attention to detail are key values in our community. Every contribution, no matter how small, is
valuable.

## Getting Started

1. **Fork the Repository**: Start by forking the Sakoo PHP Web Framework (Core) repository to your GitHub account.
2. **Clone the Repository**: Clone the forked repository to your local machine.
   ```bash
   git clone https://github.com/sakoo-dev/framework-php-core.git
   ```
3. **Build Project**: Build project & Install all required dependencies by running:
   ```bash
   make
   ```
4. **Create a Branch**: Create a new branch for your work.
   ```bash
   git checkout -b feat/your-feature-name
   ```

## Coding Style

Sakoo uses a **Custom Coding Style based on Symfony Standards**. This coding style ensures that our code is readable, maintainable, and consistent.

### Automated Style Fixing

To help you adhere to our coding standards, we use the `PHPCSFixer` tool. You can automatically apply the correct coding style to your code by running the following command:

```bash
make stylefix
```

### CI Pipeline

Our Continuous Integration (CI) pipeline includes a step to check the coding style of all contributions. If your code does not adhere to our standards, the pipeline will fail. Therefore, it's important to run `make stylefix` before submitting your code.

## Making Changes

1. **Focus on Readability and Simplicity**: When making changes, prioritize code readability and simplicity. Even a 1% improvement is valuable.
2. **Attend to Details**: Pay close attention to small details, as they contribute significantly to the overall quality of the framework.
3. **Avoid Unnecessary Dependencies**: We prefer writing systems from scratch rather than relying on third-party libraries, to maintain a customized development experience.

## Submitting a Pull Request

1. **Commit Your Changes**: Commit your changes with a clear and descriptive message.
   ```bash
   git commit -m "feat(#ISSUE_CODE): Improves readability and simplifies code structure"
   ```
2. **Push to Your Fork**: Push your changes to your forked repository.
   ```bash
   git push origin feat/your-feature-name
   ```
3. **Create a Pull Request**: Open a pull request against the `main` branch of the Sakoo PHP Web Framework (Core) repository. Provide a detailed description of your changes and explain how they align with our values.

## CI Pipeline

The Sakoo Framework has a CI pipeline that automatically runs tests, checks coding standards, and validates your contribution. Please ensure all tests pass and that your code adheres to our coding style before submitting your pull request.

If the pipeline fails due to coding style issues, you can use `make stylefix` to correct them and then push the changes again.

## Reporting Issues

If you encounter a bug or have a feature request, please create an issue on GitHub. Provide as much detail as possible, including steps to reproduce the issue, expected behavior, and screenshots if applicable.

## Learning and Support

We are here to learn from each other. If you have questions or need help with anything, feel free to reach out by opening a discussion or issue on GitHub. Don’t be afraid to make mistakes—learning and growth are central to our community.

---

Thank you for contributing to the Sakoo PHP Web Framework (Core)! We look forward to your input and collaboration.
