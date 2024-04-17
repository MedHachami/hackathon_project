import { Component } from '@angular/core';
import { EccomerceService } from '../_services/eccomerce.service';
import { ActivatedRoute } from '@angular/router';
import { URL_BACKEND } from 'src/config/config';

@Component({
  selector: 'app-categoryupdate',
  templateUrl: './categoryupdate.component.html',
  styleUrls: ['./categoryupdate.component.css']
})
export class CategoryupdateComponent {

  
  name:any=null;
  icon:any=null;
  images_file:any=null;

  images_preview:any =null;

  registrationSuccess = false;
  successMessage= "Registtration Successful"
  id:number |undefined;
  categoryDetail:any;


  constructor(
    public eccommerceService: EccomerceService,
    public route :ActivatedRoute
  ){}

  ngOnInit(){
    this.route.params.subscribe(params=>{
      this.id = + params['id']
      console.log(this.id);
      if(this.id){
        this.eccommerceService.getCategoryDetail(this.id).subscribe(data=>{
          this.name= data.categories.name;
          console.log(data.categories.name)
        })
        
      }

    })



  }

  processFile(event : Event){
  
    const target = event.target as HTMLInputElement;
    if (target.files && target.files[0]) {
      if (target.files[0].type.indexOf("image") < 0) {
        console.log("Resim dosyası değil");
        return;
      }
      this.images_file = target.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(this.images_file);
      reader.onloadend = () => (this.images_preview = reader.result);
    }
    
  }
  save(){
    if(this.id){

        let formData =  new FormData();
        
        // this.eccommerceService.update(this.id, formData).subscribe((resp:any)=>{
        //   this.registrationSuccess=true;
    
        //   setTimeout(()=>{
        //     this.registrationSuccess=false;
        //   }, 5000);
        //   console.log(resp);
          
        // })
    formData.append("name", this.name);
    this.eccommerceService.update(this.id , formData).subscribe((resp:any)=>{
      this.registrationSuccess=true;

      setTimeout(()=>{
        this.registrationSuccess=false;
      }, 5000);
    })
        
    

    }

   


   



  }
}
