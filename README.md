# Qualité logicielle Kesaco ?
## **1. Qu’est-ce que la qualité logicielle ? Comment la mesurer ? (Accelerate)**
### **Connect**
* "Ce qui m’énerve dans un logiciel"
  * Par groupes de 3 : lister 3 défauts qui rendent une app insupportable. 
  * Mise en commun : tu relies leurs exemples aux dimensions de la qualité (fiabilité, lenteur, bugs, incompréhensible…).
* Question éclair : *"Selon vous, comment mesure-t-on la qualité d’un logiciel dans une entreprise ?"*

### **Concepts**
* Micro-exposé interactif (10 min) :
    * Dimensions : lisibilité, maintenabilité, testabilité, fiabilité, performance.
    * Les 4 métriques Accelerate (DORA) en version vulgarisée.

![4-metrics.png](img/4-metrics.webp)
![performance.webp](img/performance.webp)
![5-familles.webp](img/5-familles.webp)
![24-aptitudes.png](img/24-aptitudes.webp)
![agir.png](img/agir.webp)

### **Concrete Practice**
* Mini-réflexion individuelle :
  → “Note une chose que tu fais déjà qui contribue à la qualité.”
  → “Note une chose que tu pourrais essayer dès demain.”

---

## **2. Écrire du code lisible (Clean Code + charge cognitive)**
### **Connect**
* *"Qu’est-ce qui rend ce code difficile à comprendre ?"*

```php
<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            if ($item->name != 'Aged Brie' and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                if ($item->quality > 0) {
                    if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                        $item->quality = $item->quality - 1;
                    }
                }
            } else {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                    if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->sellIn < 11) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                        if ($item->sellIn < 6) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            }

            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                $item->sellIn = $item->sellIn - 1;
            }

            if ($item->sellIn < 0) {
                if ($item->name != 'Aged Brie') {
                    if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->quality > 0) {
                            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                                $item->quality = $item->quality - 1;
                            }
                        }
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }
}
```

### **Concepts**
Slides [Clean Code](files/clean-code.pdf)

### **Concrete Practice**
* Atelier de refactoring express (15 min) : `Food` 
* Partage en groupe : 2–3 binômes projettent leur résultat.

> Et si on appliquait ces principes collectivement sur l'un de vos repos ?

### **Conclusion**
“Sur une échelle de 1 à 5, en quoi ton / votre code est plus lisible maintenant ? Pourquoi ? ”

---

## 3. Et la charge cognitive dans tout ça ?
On va parler cerveau [ici](https://speakerdeck.com/thirion/clean-code-du-point-de-vue-de-la-cognition)

## **4. Linters**
### **Connect**
Web Hunt : 
- Qu'est-ce qu'un `Linter` ?
- Qu'est-ce que l'analyse static de code ?

### **Concepts**
* Explication interactive :
    * Pourquoi c’est utile dans une équipe ?
    * Différence entre linter & formatter
* Demo `SonarCloud` [ici](https://sonarcloud.io/project/overview?id=ythirion_jurassic-code)

### **Concrete practice**
- Jour 7 du calendrier de l'Avent [ici](https://coda-school.github.io/advent-2025/?day=07).
- Tester [`phpstan`](https://phpstan.org/) / [`SonarQube for IDE`](https://www.sonarsource.com/products/sonarqube/ide/)

### **Conclusion**
* Retour individuel :
  → “Quelle règle du linter trouves-tu la plus utile et pourquoi ?”

---

## **5. Itérer grâce aux tests ?**
### **Connect - MythBusters**
In small groups, categorize each sentence about Unit tests in :
- Myth
- Truth

![Mythbusters](img/mythbusters.webp)

### Sentences
- It makes changes more difficult to make
- Using them, I don't have a piece of code that I'm afraid to touch
- Unit tests are only written by testers
- My code is so simple, so I do not need to write a single test on it
- Unit tested code is of higher quality than not tested code
- You only need unit testing when there are many developers
- It reduces the cost of development
- It takes too much time to write

<details>
  <summary markdown='span'>
  Correction
  </summary>

#### Myths
- It makes changes more difficult to make
    - Makes changes easier to make
    - Let developers refactor without fear (again, again, and again)
- Unit tests are only written by testers
    - Usually, they don’t…
    - Developers write unit tests
    - Ideally run them every time they make any change on the system
- My code is so simple, I do not need to write a single test on it
    - Simple code requires simple tests, so there are no excuses.
- You only need unit testing when there are many developers
    - Unit testing can help a one-person team just as much as a 50-person team
    - Even more risky to let a single person hold all the cards
- It takes too much time to write
    - It takes a little while to get used to, but overall will save you time and cut down on wasted time
    - Regression testing will keep things moving forward without having to worry too much
    - `How do you test your development if you do not write Unit tests?`

> Our responsibility is to reduce the cost of quality

#### Facts
- Using them, I don't have a piece of code that I'm afraid to touch
    - When you refactor / add new features it acts as a safety net and increase your confidence
- Unit tested code is of higher quality than not tested one
    - It identifies every defect that may have come up before code is sent further for integration testing
    - Writing tests makes you think harder about the problem
    - It exposes the edge cases and makes you write better code
- It reduces the cost of development
    - Since the bugs are found early, unit testing helps reduce the cost of bug fixes
    - Bugs detected earlier are easier to fix
</details>

### **Concepts**
* Courte explication :
    * But d’un test
    * La [pyramide de tests](https://martinfowler.com/articles/practical-test-pyramid.html)
    * [Quadrant de tests](https://www.all4test.fr/blog-du-testeur/la-methode-agile-et-le-test-logiciel-tous-savoir/)
    * Notion AAA (Arrange–Act–Assert)

![Unit Testing](img/unit-testing.png)
![Good vs Bad Tests](img/good-vs-bad.png)
![What is a Unit Test](img/what-is-unit-test.png)
![Anatomy of Unit Tests](img/anatomy-of-unit-test.png)
![Test Doubles](img/test-doubles.png)

[Infographie "Unit Testing Principles, Practices, and Patterns"](files/Unit%20Testing%20Principles%2C%20Practices%2C%20and%20Patterns.pdf)

### **Concrete Practice**
[“Mon premier test automatisé”](unit-tests-intro/README.md)
* Bonus : faire échouer volontairement un test → ils voient l’intérêt immédiat.

### **Conclusion**
* Question finale :
  → “Quel type de test a le plus de valeur à ton niveau actuel ? Pourquoi ?”

---
