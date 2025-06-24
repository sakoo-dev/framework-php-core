# 📚 Documentation

## 📦 Sakoo\Framework\Core\VarDump

### 🟢 VarDump

---

##### Contract

```php
public static function dieDump(mixed $vars): never
```

##### Usage

```php
VarDump::dieDump($vars)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public static function dump(mixed $vars): void
```

##### Usage

```php
VarDump::dump($vars)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

## 📦 Sakoo\Framework\Core\VarDump\Cli

### 🟢 CliDumper

---

#### How to use the Class:

```php
$cliDumper = new CliDumper(Formatter $formatter)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function dump(mixed $value): void
```

##### Usage

```php
$cliDumper->dump($value)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

### 🟢 CliFormatter

---

#### How to use the Class:

```php
$cliFormatter = new CliFormatter(Output $output)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function format(mixed $value): void
```

##### Usage

```php
$cliFormatter->format($value)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
protected function formatType(mixed $value, int $depth): string
```

##### Usage

```php
$cliFormatter->formatType($value, $depth)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

## 📦 Sakoo\Framework\Core\VarDump\Http

### 🟢 HttpDumper

---

#### How to use the Class:

```php
$httpDumper = new HttpDumper(Formatter $formatter)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function dump(mixed $value): void
```

##### Usage

```php
$httpDumper->dump($value)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

### 🟢 HttpFormatter

---

#### How to use the Class:

```php
$httpFormatter = new HttpFormatter()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function format(mixed $value): void
```

##### Usage

```php
$httpFormatter->format($value)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

