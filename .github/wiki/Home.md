# 📚 Documentation

## 📦 Sakoo\Framework\Core\Set

### 🟢 Set

---

#### How to use the Class:

```php
$set = new Set(array $items)
```

<sub><sup>
	 * @param array<int|string,T> $items
	 *
	 * @implements \IteratorAggregate<string|int, T>
	 *
	 * @throws \InvalidArgumentException|\Throwable
	 </sup></sub>

<br>

---

##### Magic Method

```php
public function __get(string $name): mixed
```

<sub><sup>
	 * @return null|T
	 *
	 * @throws \InvalidArgumentException|\Throwable
	 </sup></sub>

<br>

---

##### Magic Method

```php
public function __set(string $name, mixed $value): void
```

<sub><sup>
	 * @param T $value
	 </sup></sub>

<br>

---

##### Contract

```php
public function exists(string|int $name): bool
```

##### Usage

```php
$set->exists($name)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function count(): int
```

##### Usage

```php
$set->count()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function each(callable $callback): void
```

##### Usage

```php
$set->each($callback)
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function map(callable $callback): self
```

##### Usage

```php
$set->map($callback)
```

<sub><sup>
	 * @template U
	 *
	 * @param callable(T): U $callback
	 *
	 * @return Set<U>
	 *
	 * @throws \InvalidArgumentException|\Throwable
	 </sup></sub>

<br>

---

##### Contract

```php
public function pluck(string $key): self
```

##### Usage

```php
$set->pluck($key)
```

<sub><sup>
	 * @return Set<T>
	 *
	 * @throws \InvalidArgumentException|\Throwable
	 </sup></sub>

<br>

---

##### Contract

```php
public function add(mixed $key, mixed $value): self
```

##### Usage

```php
$set->add($key, $value)
```

<sub><sup>
	 * @return Set<T>
	 *
	 * @throws \InvalidArgumentException|\Throwable
	 </sup></sub>

<br>

---

##### Contract

```php
public function remove(string|int $key): self
```

##### Usage

```php
$set->remove($key)
```

<sub><sup>
	 * @return Set<T>
	 </sup></sub>

<br>

---

##### Contract

```php
public function get(string|int $key, mixed $default): mixed
```

##### Usage

```php
$set->get($key, $default)
```

<sub><sup>
	 * @return null|T
	 *
	 * @throws \InvalidArgumentException|\Throwable
	 </sup></sub>

<br>

---

##### Contract

```php
public function toArray(): array
```

##### Usage

```php
$set->toArray()
```

<sub><sup>
	 * @return array<T>
	 </sup></sub>

<br>

---

##### Contract

```php
public function getIterator(): ArrayIterator
```

##### Usage

```php
$set->getIterator()
```

<sub><sup>
	 * @return \ArrayIterator<int|string, T>
	 </sup></sub>

<br>

---

##### Contract

```php
public function sort(Sorter $sorter): self
```

##### Usage

```php
$set->sort($sorter)
```

<sub><sup>
	 * @param Sorter<T> $sorter
	 *
	 * @return Set<T>
	 </sup></sub>

<br>

---

##### Contract

```php
public function search(mixed $needle, Searcher $searcher): self
```

##### Usage

```php
$set->search($needle, $searcher)
```

<sub><sup>
	 * @param Searcher<T> $searcher
	 *
	 * @return Set<T>
	 </sup></sub>

<br>

---

##### Contract

```php
public function filter(callable $callback): self
```

##### Usage

```php
$set->filter($callback)
```

<sub><sup>
	 * @return Set<T>
	 *
	 * @throws \InvalidArgumentException|\Throwable
	 </sup></sub>

<br>

---

##### Contract

```php
public function first(): mixed
```

##### Usage

```php
$set->first()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function second(): mixed
```

##### Usage

```php
$set->second()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function third(): mixed
```

##### Usage

```php
$set->third()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function fourth(): mixed
```

##### Usage

```php
$set->fourth()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function fifth(): mixed
```

##### Usage

```php
$set->fifth()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function sixth(): mixed
```

##### Usage

```php
$set->sixth()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function seventh(): mixed
```

##### Usage

```php
$set->seventh()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function eighth(): mixed
```

##### Usage

```php
$set->eighth()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function ninth(): mixed
```

##### Usage

```php
$set->ninth()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

---

##### Contract

```php
public function tenth(): mixed
```

##### Usage

```php
$set->tenth()
```

<sub><sup>PHP Docs will appear here for describing methods functionality and their signature</sup></sub>

<br>

