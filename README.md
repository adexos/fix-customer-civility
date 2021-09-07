# Fix customer civility

If you want to fix this issue: https://github.com/magento/magento2/issues/32177

Launch this command for apply this patch
```bash
composer require adexos/fixcustomercivility
```

If you use this patch after the magento 2.4.2 update, several tables may be impacted.
 * sales_order_address
 * quote_address
 * customer_address_entity
