# cms

#### bug list

1.创建编辑管理员无法成功，未找到原因
2·暂时未实现所有的页面顶部搜索功能
3.页面级权限如何控制暂时会想到好的办法  ---解决


perimission 参考文档

1、http://www.cnblogs.com/yjf512/p/4516435.html
2、http://aiilive.blog.51cto.com/1925756/1297317


cms权限设计思路

总体思路：
    原始权限控制仅支持控制大模块，无法控制模块子集模块，现细化yascmf权限控制，增加权限模块表和模块表

步骤：
    1、yascmf_user（用户）表和yascmf_role_user(用户和角色关联)表字段不变化,yascmf_permissions增加字段type
    2、增加yascmf_method(模块)表，此表指的所有页面的模块
    3、增加yascmf_permission_method(权限和模块关联)表
    4、yascmf_method（模块表）sql

    CREATE TABLE IF NOT EXISTS  `yascmf_method` (
      `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
      `method_code` VARCHAR(45) NOT NULL DEFAULT '' COMMENT '模块代码',
      `name` VARCHAR(45) NOT NULL DEFAULT '' COMMENT '模块名称',
      `url` VARCHAR(1000) NOT NULL DEFAULT '' COMMENT '路由地址',
      `created_at` TIMESTAMP NULL COMMENT '',
      `updated_at` TIMESTAMP NULL COMMENT '',
      PRIMARY KEY (`id`)  COMMENT '',
      UNIQUE INDEX `id` (`id` ASC)  COMMENT '',
      UNIQUE INDEX `method_code` (`method_code` ASC)  COMMENT ''
      )ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
    COMMENT = '后台模块表';

    5、yascmf_permission_method(权限模块关联)表

