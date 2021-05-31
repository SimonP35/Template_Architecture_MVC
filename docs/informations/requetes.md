# Requêtes SQL

__Exemple : Requêtes complexes :__

## Récupérer le nom & le prix des produits de la catégorie dont l'ID est {$id} + le nom de la catégorie en question

```sql
SELECT `price`, `product`.`name` AS `product`, `category`.`name` AS `category`
FROM `product`
INNER JOIN `category` 
ON `product`.`category_id` = `category`.`id`
WHERE `product`.`category_id` = $id
```

### Récupérer le nombre de produits pour chaque catégorie

```sql
SELECT COUNT(`product`.`category_id`) AS `nb`, `category`.`id` AS `id`, `category`.`name` AS `name`
FROM `product`
INNER JOIN `category`
ON `product`.`category_id` = `category`.`id`
GROUP BY `category`.`id`

### Pages produits  

### Récupérer tous les produits

```sql
SELECT * FROM product
```

### Récupérer le produit ayant un id donné (#2)

```sql
SELECT *
FROM product
WHERE id = 2
```

## Page d'accueil

### Les 5 catégories mises en avant, dans l'ordre

```sql
SELECT * FROM `category` 
WHERE `home_order` > 0 
ORDER BY `home_order` ASC
```

## Layout

### Les 5 marques du footer

```sql
SELECT * FROM `brand` 
WHERE `footer_order` > 0 
ORDER BY `footer_order` ASC
```

### Les 5 types de produit du footer

```sql
SELECT * FROM `type` 
WHERE `footer_order` > 0 
ORDER BY `footer_order` ASC
```

## Page catégorie

### Récupérer une catégorie spécifique

```sql
SELECT * FROM `category` 
WHERE `id` = $id
```

### Récupérer toutes les catégories

```sql
SELECT * FROM `category`
```

### Récupérer les produits d'une catégorie spécifique, triés par nom

```sql
SELECT * FROM `product`
WHERE `category_id` = $category_id
ORDER BY `name` ASC
```

### Récupérer les produits d'une catégorie spécifique, triés par prix

```sql
SELECT * FROM `product`
WHERE `category_id` = $category_id
ORDER BY `price` ASC
```

### Récupérer les produits d'une catégorie spécifique, triés par note (inversé)

```sql
SELECT * FROM `product`
WHERE `category_id` = $category_id
ORDER BY `rate` DESC
```

## Page Marque

### Récupérer les produits d'une marque spécifique (tri variable)

```sql
SELECT * FROM `product`
WHERE `brand_id` = $brand_id
```

## Page Types

### Récupérer les produits d'un type spécifique (tri variable)

```sql
SELECT * FROM `product`
WHERE `type_id` = $type_id
```
