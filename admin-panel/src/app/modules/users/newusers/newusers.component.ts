import { Component } from '@angular/core';

@Component({
  selector: 'app-newusers',
  templateUrl: './newusers.component.html',
  styleUrls: ['./newusers.component.css']
})
export class NewUserComponent {

  name:any=null;
  icon:any=null;
  images_file:any=null;

  images_preview:any =null;

  registrationSuccess = false;
  successMessage= "Registtration Successful"


  constructor(
   
  ){}

  
  save(){
   


  }


}
