import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { URL_SERVICE } from 'src/config/config';
import { Observable, of } from 'rxjs';


@Injectable({
  providedIn: 'root'
})
export class HomeService {

  constructor(private http: HttpClient) { }

  getSlider(): Observable<any> {
    let URL = URL_SERVICE + '/slider/all';



    return this.http.get<any>(URL,);

  }

  home(): Observable<any> {
    let URL = URL_SERVICE + '/home';



    return this.http.get<any>(URL,);

  }

  productdetail(id: number): Observable<any> {
    let URL = URL_SERVICE + '/detail/' + id;



    return this.http.get<any>(URL,);

  }

  getAllProjects(): Observable<any> {
    let URL = URL_SERVICE + '/projects';
    const token = localStorage.getItem('token');

    if (!token) {
      return of(null);
    }
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`,
    }
    );

    return this.http.get<any>(URL, { headers });

  }

  getAllCategories(): Observable<any> {
    let URL = URL_SERVICE + '/categories';

    const token = localStorage.getItem('token');
    console.log(token)

    if (!token) {
      return of(null);
    }
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`,
    }
    );

    return this.http.get<any>(URL, { headers });

  }

  getUserHistory(): Observable<any> {
    let URL = URL_SERVICE + '/history';
    const token = localStorage.getItem('token');

    if (!token) {
      return of(null);
    }
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`,
    }
    );

    return this.http.get<any>(URL, { headers });

  }

}
