<?php

namespace App\Registration\Models;

/**
 * Used for Member Models
 * 
 * @author cmooy
 */
class Member
{
	/**
	 * boot
	 * observing model
	 *
	 */	
	public static function register($data) 
	{
		$human 		= new Human;
		$human->fill([
						'name'			=> $data['name'],
						'gender'		=> $data['gender'],
						'date_of_birth'	=> $data['date_of_birth'],
					]);

		return $human;
		$address 	= new Address;
		$address->fill([
						'address'		=> 	[
												'address'	=> $data['address'],
												'city'		=> $data['city'],
												'province'	=> $data['province'],
												'zipcode'	=> $data['zipcode'],
												'country'	=> $data['country'],
											],
					]);

		$mobile 	= new Contact;
		$mobile->fill([
						'type'		=> 'mobile',
						'account'	=> $data['mobile'],
					]);

		$whatsapp 	= new Contact;
		$whatsapp->fill([
						'type'		=> 'whatsapp',
						'account'	=> $data['whatsapp'],
					]);

		$ktp 		= new Identity;
		$ktp->fill([
						'type'		=> 'ktp',
						'number'	=> $data['ktp'],
					]);

		$npwp 		= new Identity;
		$npwp->fill([
						'type'		=> 'npwp',
						'number'	=> $data['npwp'],
					]);
		
		$sim 		= new Identity;
		$sim->fill([
						'type'		=> 'sim',
						'number'	=> $data['sim'],
					]);

		$member 	= new static([
							'human' => $human,
							'address' => $address,
							'mobile' => $mobile,
							'whatsapp' => $whatsapp,
							'ktp' => $ktp,
							'npwp' => $npwp,
							'sim' => $sim,
						]);

		return $member;
	}
}
