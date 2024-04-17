import { HomeService } from './../home/_services/home.service';
import { Router } from '@angular/router';
import { Component } from '@angular/core';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent {

  history: any[] = [];

  constructor(
    public router: Router,
    public homeService: HomeService
  ) { }

  ngOnInit() {
    this.loadUserInformation();
  }

  loadUserInformation() {
    this.homeService.getUserHistory().subscribe((data) => {
      this.history = data;
      console.log(this.history);

    },
      (error) => {
        console.error('Error fetching user history:', error);
      });
  }

}
