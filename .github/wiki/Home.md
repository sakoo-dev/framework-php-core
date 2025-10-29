# 📚 Documentation

## 📦 Sakoo\Framework\Core\Container

### 🟢 Container

---

#### How to use the Class:

```php
$container = new Container(string $cachePath)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function get(string $id): object
```

##### Usage

```php
$container->get($id)
```

<sub><sup>
	 * @throws \Throwable
	 * @throws ContainerNotFoundException
	 </sup></sub>

<br>

---

##### Contract

```php
public function has(string $id): bool
```

##### Usage

```php
$container->has($id)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function bind(string $interface, callable|object|string $factory): void
```

##### Usage

```php
$container->bind($interface, $factory)
```

<sub><sup>
	 * @throws \Throwable
	 * @throws TypeMismatchException
	 </sup></sub>

<br>

---

##### Contract

```php
public function singleton(string $interface, callable|object|string $factory): void
```

##### Usage

```php
$container->singleton($interface, $factory)
```

<sub><sup>
	 * @throws \Throwable
	 * @throws TypeMismatchException
	 </sup></sub>

<br>

---

##### Contract

```php
public function resolve(string $interface): object
```

##### Usage

```php
$container->resolve($interface)
```

<sub><sup>
	 * @throws \ReflectionException
	 * @throws \Throwable
	 * @throws ClassNotInstantiableException
	 * @throws ClassNotFoundException
	 </sup></sub>

<br>

---

##### Contract

```php
public function new(string $class, array $params): object
```

##### Usage

```php
$container->new($class, $params)
```

<sub><sup>
	 * @param array<mixed> $params
	 *
	 * @throws \ReflectionException
	 * @throws ClassNotFoundException
	 * @throws ClassNotInstantiableException
	 * @throws \Throwable
	 </sup></sub>

<br>

---

##### Contract

```php
public function clear(): void
```

##### Usage

```php
$container->clear()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function loadCache(): void
```

##### Usage

```php
$container->loadCache()
```

<sub><sup>
	 * @throws \Throwable
	 </sup></sub>

<br>

---

##### Contract

```php
public function flushCache(): bool
```

##### Usage

```php
$container->flushCache()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function cacheExists(): bool
```

##### Usage

```php
$container->cacheExists()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function dumpCache(): void
```

##### Usage

```php
$container->dumpCache()
```

<sub><sup>
	 * @throws \Throwable
	 * @throws \ReflectionException
	 * @throws ClassNotInstantiableException
	 * @throws ClassNotFoundException
	 </sup></sub>

<br>

## 📦 Sakoo\Framework\Core\Container\Exceptions

### 🟥 ClassNotFoundException

### 🟥 ClassNotInstantiableException

### 🟥 ContainerNotFoundException

### 🟥 TypeMismatchException

## 📦 Sakoo\Framework\Core\Container\Parameter

### 🟢 Parameter

---

#### How to use the Class:

```php
$parameter = new Parameter(Container $container)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function resolve(ReflectionParameter $parameter): mixed
```

##### Usage

```php
$parameter->resolve($parameter)
```

<sub><sup>
	 * @throws \Throwable
	 * @throws \ReflectionException
	 * @throws ClassNotInstantiableException
	 * @throws ClassNotFoundException
	 </sup></sub>

<br>

### 🟢 ParameterSet

---

#### How to use the Class:

```php
$parameterSet = new ParameterSet(Container $container)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function resolve(array $parameters): array
```

##### Usage

```php
$parameterSet->resolve($parameters)
```

<sub><sup>
	 * @param array<\ReflectionParameter> $parameters
	 *
	 * @return list<mixed>
	 *
	 * @throws \ReflectionException
	 * @throws ClassNotFoundException
	 * @throws ClassNotInstantiableException
	 * @throws \Throwable
	 </sup></sub>

<br>

