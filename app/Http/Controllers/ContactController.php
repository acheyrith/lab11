<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\IndexHint;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contacts;
    protected $companies;

    public function __construct()
    {
        // Fetch the Site Settings object
        $this->contacts = $this->getContacts();
        $this->companies = $this->getCompanies();
    }

    public function index()
    {
        return view('contacts.index', ['contacts' => $this->contacts, 'companies' => $this->companies]);
    }

    //Create
    public function create()
    {
        return view('contacts.create');
    }

    public function create2(Request $data = null)
    {
        if ($data != null) {
            dd($data);
            $contactData = [
                'firstname' => $data->first_name,
                'lastname' => $data->last_name,
                'email' => $data->email,
                'phone' => $data->phone,
                'address' => $data->address,
                'company' => $data->company
            ];
            array_push($this->contacts, $contactData);


            $companyData = [
                'name' => 'Company 1'
            ];
            array_push($this->companies, $companyData);
        }

        return view('contacts.index', ['contacts' => $this->contacts, 'companies' => $this->companies]);
    }

    //Show
    public function show($id)
    {
        $contacts = $this->getContacts();
        abort_if(!isset($contacts[$id]), 404);
        $contact = $contacts[$id];
        return view('contacts.show')->with('contact', $contact);
    }

    protected function getContacts()
    {
        return [
            1 => ['firstname' => 'Sok', 'lastname' => 'Dara', 'email' => 'dara@abc.com', 'phone' => '092 293 234', 'address' => 'Phnom Penh', 'company' => 'ABC'],
            2 => ['firstname' => 'Sok', 'lastname' => 'Pisey', 'email' => 'pisey@abc.com', 'phone' => '092 234 123', 'address' => 'Phnom Penh', 'company' => 'ABC'],
            3 => ['firstname' => 'Chan', 'lastname' => 'Ratha', 'email' => 'ratha@xyz.com', 'phone' => '092 234 233', 'address' => 'Phnom Penh', 'company' => 'XYZ'],
            4 => ['firstname' => 'Kos', 'lastname' => 'Borey', 'email' => 'borey@mno.com', 'phone' => '092 234 343', 'address' => 'Phnom Penh', 'company' => 'MNO'],
        ];
    }
    protected function getCompanies()
    {
        return [
            1 => ['name' => 'Company 1'],
            2 => ['name' => 'Company 2'],
        ];
    }
}
