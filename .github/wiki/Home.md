# 📚 Documentation

## 📦 Sakoo\Framework\Core\Command

### 🟢 DevCommand

---

##### Contract

```php
public static function getName(): string
```

##### Usage

```php
DevCommand::getName()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public static function getDescription(): string
```

##### Usage

```php
DevCommand::getDescription()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function run(Input $input, Output $output): int
```

##### Usage

```php
$devCommand->run($input, $output)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function setRunningApplication(Application $app): void
```

##### Usage

```php
$devCommand->setRunningApplication($app)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function getApplication(): Application
```

##### Usage

```php
$devCommand->getApplication()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

### 🟢 DocGenCommand

---

##### Contract

```php
public static function getName(): string
```

##### Usage

```php
DocGenCommand::getName()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public static function getDescription(): string
```

##### Usage

```php
DocGenCommand::getDescription()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function run(Input $input, Output $output): int
```

##### Usage

```php
$docGenCommand->run($input, $output)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function setRunningApplication(Application $app): void
```

##### Usage

```php
$docGenCommand->setRunningApplication($app)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function getApplication(): Application
```

##### Usage

```php
$docGenCommand->getApplication()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

### 🟢 ZenCommand

---

##### Contract

```php
public static function getName(): string
```

##### Usage

```php
ZenCommand::getName()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public static function getDescription(): string
```

##### Usage

```php
ZenCommand::getDescription()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function run(Input $input, Output $output): int
```

##### Usage

```php
$zenCommand->run($input, $output)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function setRunningApplication(Application $app): void
```

##### Usage

```php
$zenCommand->setRunningApplication($app)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function getApplication(): Application
```

##### Usage

```php
$zenCommand->getApplication()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

## 📦 Sakoo\Framework\Core\Command\Watcher

### 🟢 PhpBundler

---

#### How to use the Class:

```php
$phpBundler = new PhpBundler(Input $input, Output $output)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function fileModified(Event $event): void
```

##### Usage

```php
$phpBundler->fileModified($event)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function fileMoved(Event $event): void
```

##### Usage

```php
$phpBundler->fileMoved($event)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function fileDeleted(Event $event): void
```

##### Usage

```php
$phpBundler->fileDeleted($event)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

### 🟢 WatchCommand

---

##### Contract

```php
public static function getName(): string
```

##### Usage

```php
WatchCommand::getName()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public static function getDescription(): string
```

##### Usage

```php
WatchCommand::getDescription()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function run(Input $input, Output $output): int
```

##### Usage

```php
$watchCommand->run($input, $output)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function setRunningApplication(Application $app): void
```

##### Usage

```php
$watchCommand->setRunningApplication($app)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function getApplication(): Application
```

##### Usage

```php
$watchCommand->getApplication()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

