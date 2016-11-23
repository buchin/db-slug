<?php namespace Buchin\DbSlug;

use RedBeanPHP\R;
use Cocur\Slugify\Slugify;
/**
* Package
*/
class DbSlug
{
	private $slugify;
	public function __construct($dsn = null, $user = null, $password = null)
	{
		if(!R::testConnection()){
			
			if($dsn == null && $user == null && $password == null){
				R::setup();
			}
			else{
				R::setup($dsn, $user, $password);
			}
		}

		$this->slugify = new Slugify;
	}

	public function slug($table, $columns)
	{
			$collection = R::findCollection($table);

			while($item = $collection->next()){
				foreach ($columns as $column) {
					$column_slug = $column . '_slug';
					$item->{$column_slug} = $this->slugify->slugify($item->{$column});
				}
				R::store($item);
			}

			R::close();
	}
}
