---

## 📦 Sakoo\Framework\Core\Handler

### 🟩 ErrorFormatter

#### How to use the Class: 
 ```php 
 $errorFormatter = new ErrorFormatter($errorNumber, $errorString, $errorFile, $errorLine); 
 ```

PHP Docs will appear here

<br>

```php 
 public __toString(): string 
 ```

PHP Docs will appear here

<br>

### 🟩 ExceptionHandler

```php 
 public __invoke($exception) 
 ```

PHP Docs will appear here

<br>

### 🟩 ErrorHandler

```php 
 public __invoke($errorNumber, $errorString, $errorFile, $errorLine) 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Logger

### 🟩 FileLogger

```php 
 public log($level, Stringable|string $message, array $context): void 
 ```

PHP Docs will appear here

<br>

### 🟩 LogFormatter

#### How to use the Class: 
 ```php 
 $logFormatter = new LogFormatter(string $level, string $message, string $mode, string $env); 
 ```

PHP Docs will appear here

<br>

```php 
 public __toString(): string 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\VarDump

### 🟩 VarDump

#### How to use the Class: 
 ```php 
 $varDump = new VarDump(mixed $value); 
 ```

PHP Docs will appear here

<br>

```php 
 public dump(): void 
 ```

PHP Docs will appear here

<br>

```php 
 public dieDump(): never 
 ```

PHP Docs will appear here

<br>

```php 
 public __toString(): string 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Watcher

### 🟩 Watcher

#### How to use the Class: 
 ```php 
 $watcher = new Watcher(WatcherDriver $driver); 
 ```

PHP Docs will appear here

<br>

```php 
 public watch(Finder $finder, FileSystemAction $callback): self 
 ```

PHP Docs will appear here

<br>

```php 
 public run(): void 
 ```

PHP Docs will appear here

<br>

```php 
 public check(): void 
 ```

PHP Docs will appear here

<br>

### 🟩 EventTypes

```php 
 public static cases(): array 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Watcher\Inotify

### 🟩 Event

#### How to use the Class: 
 ```php 
 $event = new Event(File $file, array $event); 
 ```

PHP Docs will appear here

<br>

```php 
 public getFile(): File 
 ```

PHP Docs will appear here

<br>

```php 
 public getHandlerId(): int 
 ```

PHP Docs will appear here

<br>

```php 
 public getType(): EventTypes 
 ```

PHP Docs will appear here

<br>

```php 
 public getGroupId() 
 ```

PHP Docs will appear here

<br>

```php 
 public getName(): string 
 ```

PHP Docs will appear here

<br>

### 🟩 File

#### How to use the Class: 
 ```php 
 $file = new File(int $id, string $path, FileSystemAction $callback); 
 ```

PHP Docs will appear here

<br>

```php 
 public getId(): int 
 ```

PHP Docs will appear here

<br>

```php 
 public getCallback(): FileSystemAction 
 ```

PHP Docs will appear here

<br>

```php 
 public getPath(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public getLocker(): Locker 
 ```

PHP Docs will appear here

<br>

### 🟩 Inotify

#### How to use the Class: 
 ```php 
 $inotify = new Inotify(); 
 ```

PHP Docs will appear here

<br>

```php 
 public watch(string $file, FileSystemAction $callback): void 
 ```

PHP Docs will appear here

<br>

```php 
 public wait(): Iteratable 
 ```

PHP Docs will appear here

<br>

```php 
 public blind($id): bool 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Markdown

### 🟩 Markdown

#### How to use the Class: 
 ```php 
 $markdown = new Markdown(); 
 ```

PHP Docs will appear here

<br>

```php 
 public write(string $value): void 
 ```

PHP Docs will appear here

<br>

```php 
 public writeLine(string $value): void 
 ```

PHP Docs will appear here

<br>

```php 
 public br(): void 
 ```

PHP Docs will appear here

<br>

```php 
 public fbr(): void 
 ```

PHP Docs will appear here

<br>

```php 
 public callout(string $value): void 
 ```

PHP Docs will appear here

<br>

```php 
 public h1(string $value): void 
 ```

PHP Docs will appear here

<br>

```php 
 public h2(string $value): void 
 ```

PHP Docs will appear here

<br>

```php 
 public h3(string $value): void 
 ```

PHP Docs will appear here

<br>

```php 
 public h4(string $value): void 
 ```

PHP Docs will appear here

<br>

```php 
 public h5(string $value): void 
 ```

PHP Docs will appear here

<br>

```php 
 public h6(string $value): void 
 ```

PHP Docs will appear here

<br>

```php 
 public ul(string $value): void 
 ```

PHP Docs will appear here

<br>

```php 
 public link(string $url, string $text): void 
 ```

PHP Docs will appear here

<br>

```php 
 public image(string $path, string $alt): void 
 ```

PHP Docs will appear here

<br>

```php 
 public checklist(string $value, bool $checked): void 
 ```

PHP Docs will appear here

<br>

```php 
 public hr(): void 
 ```

PHP Docs will appear here

<br>

```php 
 public code(string $value): void 
 ```

PHP Docs will appear here

<br>

```php 
 public inlineCode(string $value): void 
 ```

PHP Docs will appear here

<br>

```php 
 public get(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public __toString(): string 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Path

### 🟩 Path

```php 
 public static getRootDir(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public static getCoreDir(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public static getVendorDir(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public static getStorageDir(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public static getLogsDir(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public static getTempTestDir(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public static getProjectPHPFiles(): Finder 
 ```

PHP Docs will appear here

<br>

```php 
 public static getCorePHPFiles(array|string $exclude): Finder 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\FileSystem\Storages\Local

### 🟩 Local

#### How to use the Class: 
 ```php 
 $local = new Local(string $path); 
 ```

PHP Docs will appear here

<br>

```php 
 public create(bool $asDirectory): bool 
 ```

PHP Docs will appear here

<br>

```php 
 public mkdir(bool $recursive): bool 
 ```

PHP Docs will appear here

<br>

```php 
 public exists(): bool 
 ```

PHP Docs will appear here

<br>

```php 
 public remove(): bool 
 ```

PHP Docs will appear here

<br>

```php 
 public isDir(): bool 
 ```

PHP Docs will appear here

<br>

```php 
 public move(string $to): bool 
 ```

PHP Docs will appear here

<br>

```php 
 public copy(string $to): bool 
 ```

PHP Docs will appear here

<br>

```php 
 public parentDir(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public rename(string $to): bool 
 ```

PHP Docs will appear here

<br>

```php 
 public files(): array 
 ```

PHP Docs will appear here

<br>

```php 
 public write(string $data): bool 
 ```

PHP Docs will appear here

<br>

```php 
 public append(string $data): bool 
 ```

PHP Docs will appear here

<br>

```php 
 public readLines(): array|false 
 ```

PHP Docs will appear here

<br>

```php 
 public setPermission(string|int $permission): bool 
 ```

PHP Docs will appear here

<br>

```php 
 public getPermission(): mixed 
 ```

PHP Docs will appear here

<br>

```php 
 public getPath(): string 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\FileSystem

### 🟩 File

```php 
 public static open(Disk $storage, string $path): Storage 
 ```

PHP Docs will appear here

<br>

#### How to use the Class: 
 ```php 
 $file = new File(string $path, Disk $storage); 
 ```

PHP Docs will appear here

<br>

### 🟩 Disk

```php 
 public static cases(): array 
 ```

PHP Docs will appear here

<br>

```php 
 public static from(string|int $value): static 
 ```

PHP Docs will appear here

<br>

```php 
 public static tryFrom(string|int $value): static 
 ```

PHP Docs will appear here

<br>

### 🟩 Permission

```php 
 public static allNothing(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public static allExecute(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public static allWrite(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public static allExecuteWrite(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public static allRead(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public static allExecuteRead(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public static allWriteRead(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public static allExecuteWriteRead(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public static getExecutables(): array 
 ```

PHP Docs will appear here

<br>

```php 
 public static getNotExecutables(): array 
 ```

PHP Docs will appear here

<br>

```php 
 public static getWritables(): array 
 ```

PHP Docs will appear here

<br>

```php 
 public static getNotWritables(): array 
 ```

PHP Docs will appear here

<br>

```php 
 public static getReadables(): array 
 ```

PHP Docs will appear here

<br>

```php 
 public static getNotReadables(): array 
 ```

PHP Docs will appear here

<br>

```php 
 public static make(int $user, int $group, int $others): string 
 ```

PHP Docs will appear here

<br>

```php 
 public static getFileDefault(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public static getDirectoryDefault(): string 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Assert

### 🟩 LazyAssertion

#### How to use the Class: 
 ```php 
 $lazyAssertion = new LazyAssertion(); 
 ```

PHP Docs will appear here

<br>

```php 
 public __call(string $name, array $arguments) 
 ```

PHP Docs will appear here

<br>

```php 
 public that(mixed $value, string $chainName): static 
 ```


	 * @return AssertionChain
	 

<br>

```php 
 public validate(): void 
 ```

PHP Docs will appear here

<br>

### 🟩 Assert

```php 
 public static that(mixed $value): AssertionChain 
 ```

PHP Docs will appear here

<br>

```php 
 public static lazy(): LazyAssertion 
 ```

PHP Docs will appear here

<br>

```php 
 public static true(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static false(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static bool(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notBool(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static callable(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notCallable(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static dir(string $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notDir(string $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static file(string $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notFile(string $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static link(string $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notLink(string $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static uploadedFile(string $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notUploadedFile(string $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static executableFile(string $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notExecutableFile(string $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static writableFile(string $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notWritableFile(string $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static readableFile(string $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notReadableFile(string $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static exists(string $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notExists(string $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static length(string $value, int $length, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static count(Countable|array $value, int $count, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static equals(mixed $value, mixed $expected, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notEquals(mixed $value, mixed $expected, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static same(mixed $value, mixed $expected, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notSame(mixed $value, mixed $expected, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static empty(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notEmpty(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static null(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notNull(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static numeric(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notNumeric(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static finite(float $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static infinite(float $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static float(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notFloat(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static int(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notInt(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static greater(int $value, int $expected, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static greaterOrEquals(int $value, int $expected, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static lower(int $value, int $expected, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static lowerOrEquals(int $value, int $expected, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static object(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notObject(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static instanceOf(mixed $value, string $class, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notInstanceOf(mixed $value, string $class, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static resource(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notResource(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static scalar(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notScalar(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static string(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notString(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static array(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notArray(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static countable(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notCountable(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static iterable(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

```php 
 public static notIterable(mixed $value, string $message): void 
 ```

PHP Docs will appear here

<br>

### 🟩 AssertionChain

#### How to use the Class: 
 ```php 
 $assertionChain = new AssertionChain(mixed $value); 
 ```

PHP Docs will appear here

<br>

```php 
 public __call(string $name, array $arguments) 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Assert\Exception

### 🟥 LazyAssertionException

```php 
 public static init(array $exceptions): static 
 ```

PHP Docs will appear here

<br>

### 🟥 InvalidArgumentException

---

## 📦 Sakoo\Framework\Core\Regex

### 🟩 Regex

```php 
 public static make(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public safeAdd(string $value): static 
 ```

PHP Docs will appear here

<br>

```php 
 public add(string $value): static 
 ```

PHP Docs will appear here

<br>

```php 
 public startOfLine(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public endOfLine(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public startsWith(callable|string $value): static 
 ```

PHP Docs will appear here

<br>

```php 
 public endsWith(callable|string $value): static 
 ```

PHP Docs will appear here

<br>

```php 
 public digit(int $length): static 
 ```

PHP Docs will appear here

<br>

```php 
 public oneOf(array $value): static 
 ```

PHP Docs will appear here

<br>

```php 
 public wrap(callable|string $value, bool $nonCapturing): static 
 ```

PHP Docs will appear here

<br>

```php 
 public bracket(callable|string $value): static 
 ```

PHP Docs will appear here

<br>

```php 
 public maybe(string $value): static 
 ```

PHP Docs will appear here

<br>

```php 
 public anything(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public something(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public unixLineBreak(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public windowsLineBreak(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public tab(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public space(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public word(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public chars($values): static 
 ```

PHP Docs will appear here

<br>

```php 
 public anythingWithout(callable|string $value): static 
 ```

PHP Docs will appear here

<br>

```php 
 public somethingWithout(callable|string $value): static 
 ```

PHP Docs will appear here

<br>

```php 
 public anythingWith(callable|string $value): static 
 ```

PHP Docs will appear here

<br>

```php 
 public somethingWith(callable|string $value): static 
 ```

PHP Docs will appear here

<br>

```php 
 public escapeChars(string $value): string 
 ```

PHP Docs will appear here

<br>

```php 
 public lookahead(callable|string $value): static 
 ```

PHP Docs will appear here

<br>

```php 
 public lookbehind(callable|string $value): static 
 ```

PHP Docs will appear here

<br>

```php 
 public negativeLookahead(callable|string $value): static 
 ```

PHP Docs will appear here

<br>

```php 
 public negativeLookbehind(callable|string $value): static 
 ```

PHP Docs will appear here

<br>

```php 
 public match(string $value): array 
 ```

PHP Docs will appear here

<br>

```php 
 public matchAll(string $value): array 
 ```

PHP Docs will appear here

<br>

```php 
 public test(string $value): bool 
 ```

PHP Docs will appear here

<br>

```php 
 public replace(Stringable|string $string, string $replace): array|string|null 
 ```

PHP Docs will appear here

<br>

```php 
 public split(Stringable|string $subject): array|false 
 ```

PHP Docs will appear here

<br>

```php 
 public get(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public __toString(): string 
 ```

PHP Docs will appear here

<br>

### 🟩 RegexHelper

```php 
 public static findCamelCase(): Regex 
 ```

PHP Docs will appear here

<br>

```php 
 public static getSpaceBetweenWords(): Regex 
 ```

PHP Docs will appear here

<br>

```php 
 public static getSpecialChars(): Regex 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Env

### 🟩 Env

```php 
 public static get(string $key, mixed $default): mixed 
 ```

PHP Docs will appear here

<br>

```php 
 public static load(Storage $file): void 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core

### 🟩 Constants

---

## 📦 Sakoo\Framework\Core\Utilities

### 🟩 Locker

```php 
 public lock(): void 
 ```

PHP Docs will appear here

<br>

```php 
 public unlock(): void 
 ```

PHP Docs will appear here

<br>

```php 
 public isLocked(): bool 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Testing

### 🟩 ExceptionAssertion

#### How to use the Class: 
 ```php 
 $exceptionAssertion = new ExceptionAssertion($phpunit, $fn); 
 ```

PHP Docs will appear here

<br>

```php 
 public withCode(int $code): static 
 ```

PHP Docs will appear here

<br>

```php 
 public withType(string $type): static 
 ```

PHP Docs will appear here

<br>

```php 
 public withMessage(string $message): static 
 ```

PHP Docs will appear here

<br>

```php 
 public validate(): void 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Container

### 🟩 Container

#### How to use the Class: 
 ```php 
 $container = new Container(); 
 ```

PHP Docs will appear here

<br>

```php 
 public get(string $id): object 
 ```

PHP Docs will appear here

<br>

```php 
 public has(string $id): bool 
 ```

PHP Docs will appear here

<br>

```php 
 public bind(string $interface, $factory): void 
 ```

PHP Docs will appear here

<br>

```php 
 public singleton(string $interface, $factory): void 
 ```

PHP Docs will appear here

<br>

```php 
 public resolve(string $interface): object 
 ```

PHP Docs will appear here

<br>

```php 
 public new(string $class): object 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Container\Exceptions

### 🟥 TypeMismatchException

### 🟥 ClassNotFoundException

### 🟥 ContainerNotFoundException

#### How to use the Class: 
 ```php 
 $containerNotFoundException = new ContainerNotFoundException(); 
 ```

PHP Docs will appear here

<br>

### 🟥 ClassNotInstantiableException

---

## 📦 Sakoo\Framework\Core\Container\Parameter

### 🟩 ParameterSet

#### How to use the Class: 
 ```php 
 $parameterSet = new ParameterSet(Container $container); 
 ```

PHP Docs will appear here

<br>

```php 
 public resolve(array $parameters): array 
 ```

PHP Docs will appear here

<br>

### 🟩 Parameter

#### How to use the Class: 
 ```php 
 $parameter = new Parameter(Container $container); 
 ```

PHP Docs will appear here

<br>

```php 
 public resolve(ReflectionParameter $parameter): mixed 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Doc

### 🟩 Doc

#### How to use the Class: 
 ```php 
 $doc = new Doc(Finder $finder, Formatter $formatter, Storage $docFile); 
 ```

PHP Docs will appear here

<br>

```php 
 public generate(): void 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Doc\Formatters

### 🟩 ClassBasedFormatter

```php 
 public format(array $data): string 
 ```

PHP Docs will appear here

<br>

### 🟩 NamespaceBasedFormatter

```php 
 public format(array $data): string 
 ```

PHP Docs will appear here

<br>

### 🟩 TocFormatter

```php 
 public format(array $data): string 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Profiler

### 🟩 Profiler

#### How to use the Class: 
 ```php 
 $profiler = new Profiler(ClockInterface $clock); 
 ```

PHP Docs will appear here

<br>

```php 
 public elapsedTime(): int 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Set

### 🟩 Set

#### How to use the Class: 
 ```php 
 $set = new Set(array $items); 
 ```

PHP Docs will appear here

<br>

```php 
 public __get(string $name): mixed 
 ```

PHP Docs will appear here

<br>

```php 
 public __set(string $name, $value): void 
 ```

PHP Docs will appear here

<br>

```php 
 public exists($name): bool 
 ```

PHP Docs will appear here

<br>

```php 
 public count(): int 
 ```

PHP Docs will appear here

<br>

```php 
 public each($callback): void 
 ```

PHP Docs will appear here

<br>

```php 
 public map($callback): static 
 ```

PHP Docs will appear here

<br>

```php 
 public pluck($key): static 
 ```

PHP Docs will appear here

<br>

```php 
 public add($key, $value): static 
 ```

PHP Docs will appear here

<br>

```php 
 public remove($key): static 
 ```

PHP Docs will appear here

<br>

```php 
 public get($key, $default): mixed 
 ```

PHP Docs will appear here

<br>

```php 
 public toArray(): array 
 ```

PHP Docs will appear here

<br>

```php 
 public getIterator(): ArrayIterator 
 ```

PHP Docs will appear here

<br>

```php 
 public first(): mixed 
 ```

PHP Docs will appear here

<br>

```php 
 public second(): mixed 
 ```

PHP Docs will appear here

<br>

```php 
 public third(): mixed 
 ```

PHP Docs will appear here

<br>

```php 
 public fourth(): mixed 
 ```

PHP Docs will appear here

<br>

```php 
 public fifth(): mixed 
 ```

PHP Docs will appear here

<br>

```php 
 public sixth(): mixed 
 ```

PHP Docs will appear here

<br>

```php 
 public seventh(): mixed 
 ```

PHP Docs will appear here

<br>

```php 
 public eighth(): mixed 
 ```

PHP Docs will appear here

<br>

```php 
 public ninth(): mixed 
 ```

PHP Docs will appear here

<br>

```php 
 public tenth(): mixed 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Exception

### 🟩 Exception

---

## 📦 Sakoo\Framework\Core\Str

### 🟩 Str

#### How to use the Class: 
 ```php 
 $str = new Str(string $value); 
 ```

PHP Docs will appear here

<br>

```php 
 public length(): int 
 ```

PHP Docs will appear here

<br>

```php 
 public uppercaseWords(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public uppercase(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public lowercase(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public upperFirst(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public lowerFirst(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public reverse(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public contains(string $substring): bool 
 ```

PHP Docs will appear here

<br>

```php 
 public replace(string $search, string $replace): static 
 ```

PHP Docs will appear here

<br>

```php 
 public trim(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public slug(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public camelCase(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public get(): string 
 ```

PHP Docs will appear here

<br>

```php 
 public __toString(): string 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Kernel

### 🟩 Mode

```php 
 public static cases(): array 
 ```

PHP Docs will appear here

<br>

```php 
 public static from(string|int $value): static 
 ```

PHP Docs will appear here

<br>

```php 
 public static tryFrom(string|int $value): static 
 ```

PHP Docs will appear here

<br>

### 🟩 Environment

```php 
 public static cases(): array 
 ```

PHP Docs will appear here

<br>

```php 
 public static from(string|int $value): static 
 ```

PHP Docs will appear here

<br>

```php 
 public static tryFrom(string|int $value): static 
 ```

PHP Docs will appear here

<br>

### 🟩 Kernel

```php 
 public static prepare(Mode $mode, Environment $environment): static 
 ```

PHP Docs will appear here

<br>

```php 
 public static getInstance(): static 
 ```

PHP Docs will appear here

<br>

```php 
 public run(): void 
 ```

PHP Docs will appear here

<br>

```php 
 public getMode(): Mode 
 ```

PHP Docs will appear here

<br>

```php 
 public getEnvironment(): Environment 
 ```

PHP Docs will appear here

<br>

```php 
 public getProfiler(): ProfilerInterface 
 ```

PHP Docs will appear here

<br>

```php 
 public getContainer(): ContainerInterface 
 ```

PHP Docs will appear here

<br>

```php 
 public setExceptionHandler(callable $handler): static 
 ```

PHP Docs will appear here

<br>

```php 
 public setErrorHandler(callable $handler): static 
 ```

PHP Docs will appear here

<br>

```php 
 public setServerTimezone(string $timezone): static 
 ```

PHP Docs will appear here

<br>

```php 
 public setServiceLoaders(array $serviceLoaders): static 
 ```

PHP Docs will appear here

<br>

```php 
 public isInTestMode(): bool 
 ```

PHP Docs will appear here

<br>

```php 
 public isInHttpMode(): bool 
 ```

PHP Docs will appear here

<br>

```php 
 public isInConsoleMode(): bool 
 ```

PHP Docs will appear here

<br>

```php 
 public isInDebugEnv(): bool 
 ```

PHP Docs will appear here

<br>

```php 
 public isInProductionEnv(): bool 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Kernel\Exceptions

### 🟥 KernelTwiceCallException

---

## 📦 Sakoo\Framework\Core\Clock\Exceptions

### 🟥 ClockTestModeException

---

## 📦 Sakoo\Framework\Core\Clock

### 🟩 Clock

```php 
 public static setTestNow(string $datetime): void 
 ```

PHP Docs will appear here

<br>

```php 
 public now(): DateTimeImmutable 
 ```


	 * @throws \Exception
	 

<br>

---

## 📦 Sakoo\Framework\Core\ServiceLoader

### 🟩 MainServiceLoader

```php 
 public load(Container $container): void 
 ```

PHP Docs will appear here

<br>

### 🟩 WatcherServiceLoader

```php 
 public load(Container $container): void 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Console

### 🟩 Assistant

#### How to use the Class: 
 ```php 
 $assistant = new Assistant(Application $console); 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Console\WatcherActions

### 🟩 PhpBundler

#### How to use the Class: 
 ```php 
 $phpBundler = new PhpBundler(SymfonyStyle $style); 
 ```

PHP Docs will appear here

<br>

```php 
 public fileModified(Event $event) 
 ```

PHP Docs will appear here

<br>

```php 
 public fileMoved(Event $event) 
 ```

PHP Docs will appear here

<br>

```php 
 public fileDeleted(Event $event) 
 ```

PHP Docs will appear here

<br>

---

## 📦 Sakoo\Framework\Core\Console\Commands

### 🟩 ZenCommand

```php 
 public execute(InputInterface $input, OutputInterface $output): int 
 ```

PHP Docs will appear here

<br>

### 🟩 DocGenCommand

```php 
 protected execute(InputInterface $input, OutputInterface $output): int 
 ```

PHP Docs will appear here

<br>

### 🟩 WatchCommand

```php 
 public execute(InputInterface $input, OutputInterface $output): int 
 ```

PHP Docs will appear here

<br>

