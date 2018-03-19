<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contacts;
use App\Http\Requests\ContactsRequest;

class ContactsController extends Controller
{
  /**
   * Contructor
   */
  public function __construct() {
    $this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactsRequest $request)
    {
      try {
        Contacts::create($request->all());
        \Notify::success('Contacto Agregado', 'Información');
        return redirect()->route('employees.show', $request->employee_id);
      } catch (\Exception $e) {
        switch ($e->getCode()) {
          default:
            \Notify::error($e-getMessage(), 'Error '.$e->getCode());
            return redirect()->back();
        }
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      return view('contacts.edit')->with('contact', Contacts::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactsRequest $request, $id)
    {
      $contact = Contacts::find($id);

      try {
        $contact->update($request->all());
        \Notify::success('Contacto Actualizado', 'Información');
        return redirect()->route('employees.show', $request->employee_id);
      } catch (\Exception $e) {
        switch ($e->getCode()) {
          default:
            \Notify::error($e-getMessage(), 'Error '.$e->getCode());
            return redirect()->back();
        }
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        Contacts::destroy($id);
        \Notify::success('Contacto borrado', 'Información');
        return redirect()->back();
      } catch (\Exception $e) {
        switch ($e->getCode()) {
          default:
          \Notify::error($e->getMessage(), 'Error '.$e->getCode());
          return redirect()->back();
        }
      }
    }
}
