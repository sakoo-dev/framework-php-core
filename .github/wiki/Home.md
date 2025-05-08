# 📚 Documentation

## 📦 Sakoo\Framework\Core\Clock

### 🟢 Clock

---

##### Contract

```php
public static function setTestNow(string $datetime): void
```

##### Usage

```php
Clock::setTestNow($datetime)
```

<sub><sup>
	 * @throws ClockTestModeException|\Throwable
	 </sup></sub>

<br>

---

##### Contract

```php
public function now(): DateTimeImmutable
```

##### Usage

```php
$clock->now()
```

<sub><sup>
	 * @throws \Exception
	 </sup></sub>

<br>

## 📦 Sakoo\Framework\Core\Clock\Exceptions

### 🟥 ClockTestModeException

