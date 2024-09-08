## Add plugin for dev
Copy plugins from folder wp-content/plugins-dev to wp-content/plugins

## Folder has too big size
- uploads
- ai1wm-backups
- plugins

## Change domain to local
UPDATE csl_options 
SET 
    option_value = REPLACE(option_value,
        'https://thelocalbesties.com',
        'http://localhost:8080')
WHERE
    option_name = 'home'
        OR option_name = 'siteurl';

UPDATE csl_posts 
SET 
    guid = REPLACE(guid,
        'https://thelocalbesties.com',
        'http://localhost:8080');

UPDATE csl_posts 
SET 
    post_content = REPLACE(post_content,
        'https://thelocalbesties.com',
        'http://localhost:8080');
        
UPDATE csl_postmeta 
SET 
    meta_value = REPLACE(meta_value,
        'https://thelocalbesties.com',
        'http://localhost:8080');