<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Address;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('places')->delete();
        DB::table('addresses')->delete();
        $json = File::get("database/data/places.json");
        $json =$json;
        $data = json_decode($json, true);
//        foreach ($data as &$record) {
//            $record['name'] = utf8_decode($record['name']);
//            $record['kerivnik'] = utf8_decode($record['kerivnik']);
//			$record['city'] = utf8_decode($record['city']);
//			$record['street'] = utf8_decode($record['street']);
//			$record['number'] = utf8_decode($record['number']);
//			$record['tel'] = utf8_decode($record['tel']);
//			$record['email'] = utf8_decode($record['email']);
//			$record['site'] = utf8_decode($record['site']);
//			$record['category_id'] = utf8_decode($record['category_id']);
//        }
        foreach ($data as $record){
            $addr = new Address($record);
            $address = Address::firstOrCreate($addr->toArray());
            $address->place()->create($record);

//            User::create(array(
//                'id' => $obj->id,
//                'email' => $obj->email,
//                'first_name' => $obj->first_name,
//                'last_name' => $obj->last_name,
//                'password' => $obj->password
//            ));
        }
    }

}
