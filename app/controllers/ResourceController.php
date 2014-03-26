<?php

interface ResourceController{

	public function index();
	public function create();
	public function update($id);
	public function store();
	public function edit($id);
	public function destroy($id);
	public function show($id);
}