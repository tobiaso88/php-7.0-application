<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'php-7.0-application');

// Project repository
set('repository', 'git@github.com:tobiaso88/php-7.0-application.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_files', [
	'.env'
]);
set('shared_dirs', []);

// Writable dirs by web server 
set('writable_dirs', [
	'storage',
]);
set('allow_anonymous_stats', false);
// set('writable_use_sudo', true);
set('writable_chmod_recursive', true);
set('writable_chmod_mode', '0775');
set('http_user', 'www-data');

// Hosts

host('16.170.163.150')
    ->set('deploy_path', '/var/www/{{application}}');

// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:test_vendors',
    'app:migrate',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

desc('Install vendors for tests');
task('deploy:test_vendors', function () {
    if (!commandExist('unzip')) {
        writeln('<comment>To speed up composer installation setup "unzip" command with PHP zip extension https://goo.gl/sxzFcD</comment>');
    }
    run('cd {{release_path}}/tests && {{bin/composer}} {{composer_options}}');
});

desc('Execute artisan migrate');
task('app:migrate', function () {
    run('cd {{release_path}}/tests && ./vendor/bin/phinx migrate');
})->once();
