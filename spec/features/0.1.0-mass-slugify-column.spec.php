<?php
use RedBeanPHP\R;
use Buchin\DbSlug\DbSlug;

describe('0.1.0 - Feature: Mass slugify column', function(){
	context('User story:', function(){
		describe('As a user', function(){});
		describe('I want to create slug for my existing column', function(){});
		describe('So I can build SEO friendly URL', function(){});
	});

	context('Scenario:', function(){

		
		given('columns', function(){
			return ['nama', 'kategori', 'kota'];
		});

		given('dsn', function(){
			return "mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;dbname=test";
		});

		given('user', function(){
			return 'root';
		});

		given('password', function(){
			return 'root';
		});

		describe('User slugify existing columns in database', function(){
			beforeAll(function(){
				$this->dbSlug = new DbSlug($this->dsn, $this->user, $this->password);
				R::nuke();
			});

			it('creates slug columns automatically', function(){
				$bean = R::dispense('usaha');
				$bean->nama = 'Jaya abadi';
				$bean->alamat = 'Jalan Jakarta B5-17';
				$bean->kategori = 'Toko Bangunan';
				$bean->kota = 'Mojokerto';

				R::store($bean);

				$this->dbSlug->slug('usaha', $this->columns);
				$columns = R::inspect('usaha');
				expect(isset($columns[$this->columns[0] . '_slug']))->toBe(true);
			});

			it('add slugged string into slug columns', function(){
				$bean = R::findOne('usaha', ' order by id desc');
				expect($bean->nama_slug)->not->toBeEmpty();
			});

			afterAll(function(){
				// R::wipe('usaha');
			});
		});
	});
});