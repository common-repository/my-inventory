SET FOREIGN_KEY_CHECKS = 0;

@new_command@
ALTER TABLE `@wp_@myi_mst_roles` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

@new_command@
REPAIR TABLE `@wp_@myi_mst_roles`;

@new_command@
OPTIMIZE TABLE `@wp_@myi_mst_roles`;

@new_command@
ALTER TABLE `@wp_@myi_mst_client`  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

@new_command@
REPAIR TABLE `@wp_@myi_mst_client`;

@new_command@
OPTIMIZE TABLE `@wp_@myi_mst_client`;

@new_command@
ALTER TABLE `@wp_@myi_logm_client`  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

@new_command@
REPAIR TABLE `@wp_@myi_logm_client`;

@new_command@
OPTIMIZE TABLE `@wp_@myi_logm_client`;

@new_command@
ALTER TABLE `@wp_@myi_mst_user_client_role`  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

@new_command@
REPAIR TABLE `@wp_@myi_mst_user_client_role`;

@new_command@
OPTIMIZE TABLE `@wp_@myi_mst_user_client_role`;

@new_command@
ALTER TABLE `@wp_@myi_mst_location`  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

@new_command@
REPAIR TABLE `@wp_@myi_mst_location`;

@new_command@
OPTIMIZE TABLE `@wp_@myi_mst_location`;

@new_command@
ALTER TABLE `@wp_@myi_logm_location`  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

@new_command@
REPAIR TABLE `@wp_@myi_logm_location`;

@new_command@
OPTIMIZE TABLE `@wp_@myi_logm_location`;

@new_command@
ALTER TABLE `@wp_@myi_mst_uom`  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

@new_command@
REPAIR TABLE `@wp_@myi_mst_uom`;

@new_command@
OPTIMIZE TABLE `@wp_@myi_mst_uom`;

@new_command@
ALTER TABLE `@wp_@myi_logm_uom`  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

@new_command@
REPAIR TABLE `@wp_@myi_logm_uom`;

@new_command@
OPTIMIZE TABLE `@wp_@myi_logm_uom`;

@new_command@
ALTER TABLE `@wp_@myi_mst_product`  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

@new_command@
REPAIR TABLE `@wp_@myi_mst_product`;

@new_command@
OPTIMIZE TABLE `@wp_@myi_mst_product`;

@new_command@
ALTER TABLE `@wp_@myi_logm_product`  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

@new_command@
REPAIR TABLE `@wp_@myi_logm_product`;

@new_command@
OPTIMIZE TABLE `@wp_@myi_logm_product`;

@new_command@
ALTER TABLE `@wp_@myi_mst_product_uom`  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

@new_command@
REPAIR TABLE `@wp_@myi_mst_product_uom`;

@new_command@
OPTIMIZE TABLE `@wp_@myi_mst_product_uom`;

@new_command@
ALTER TABLE `@wp_@myi_logm_product_uom`  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

@new_command@
REPAIR TABLE `@wp_@myi_logm_product_uom`;

@new_command@
OPTIMIZE TABLE `@wp_@myi_logm_product_uom`;

@new_command@
ALTER TABLE `@wp_@myi_mst_category`  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

@new_command@
REPAIR TABLE `@wp_@myi_mst_category`;

@new_command@
OPTIMIZE TABLE `@wp_@myi_mst_category`;

@new_command@
ALTER TABLE `@wp_@myi_logm_category`  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

@new_command@
REPAIR TABLE `@wp_@myi_logm_category`;

@new_command@
OPTIMIZE TABLE `@wp_@myi_logm_category`;

@new_command@
ALTER TABLE `@wp_@myi_mst_category_product`  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

@new_command@
REPAIR TABLE `@wp_@myi_mst_category_product`;

@new_command@
OPTIMIZE TABLE `@wp_@myi_mst_category_product`;

@new_command@
ALTER TABLE `@wp_@myi_logm_category_product`  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

@new_command@
REPAIR TABLE `@wp_@myi_logm_category_product`;

@new_command@
OPTIMIZE TABLE `@wp_@myi_logm_category_product`;

@new_command@
ALTER TABLE `@wp_@myi_txt_inventory`  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

@new_command@
REPAIR TABLE `@wp_@myi_txt_inventory`;

@new_command@
OPTIMIZE TABLE `@wp_@myi_txt_inventory`;


@new_command@
SET FOREIGN_KEY_CHECKS = 1;