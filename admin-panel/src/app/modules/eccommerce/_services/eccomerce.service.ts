import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, of } from 'rxjs';
import { URL_SERVICE } from 'src/config/config';

@Injectable({
  providedIn: 'root'
})
export class EccomerceService {

  constructor(private http: HttpClient) { }

  getCategory():Observable<any>{
    let URL = URL_SERVICE + '/categories';

    const token = localStorage.getItem('token');
    console.log(token)

    if(!token)
    {
      return of(null);
    }
    const headers = new HttpHeaders({
        'Authorization': `Bearer ${token}`,}
    );

    return this.http.get<any>(URL, {headers});

      
  }

  deletecategory(userId:number):Observable<any>{
    let URL = URL_SERVICE + '/categories/' +userId;

    const token = localStorage.getItem('token');

    if(!token)
    {
      return of(null);
    }
    const headers = new HttpHeaders({
        'Authorization': `Bearer ${token}`,}
    );

    return this.http.delete<any>(URL, {headers});
      
  }

  create(data:any):Observable<any>{
    let URL = URL_SERVICE + '/categories';

    const token = localStorage.getItem('token');

    if(!token)
    {
      return of(null);
    }
    const headers = new HttpHeaders({
        'Authorization': `Bearer ${token}`,}
    );

    return this.http.post<any>(URL, data, {headers});
      
  }
  getCategoryDetail(id:number):Observable<any>{
    let URL = URL_SERVICE + '/categories/' +id;

    const token = localStorage.getItem('token');

    if(!token)
    {
      return of(null);
    }
    const headers = new HttpHeaders({
        'Authorization': `Bearer ${token}`,}
    );

    return this.http.get<any>(URL, {headers});
      
  }

  
  update(id:number, data:any):Observable<any>{
    let URL = URL_SERVICE + '/categories/' +id;

    const token = localStorage.getItem('token');

    if(!token)
    {
      return of(null);
    }
    const headers = new HttpHeaders({
        'Authorization': `Bearer ${token}`,}
    );

    return this.http.put<any>(URL, data,  {headers});
      
  }
}
