import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { SharedService } from 'src/app/shared/_services/shared.service';
import { URL_BACKEND } from 'src/config/config';
import { HomeService } from '../_services/home.service';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent {
  searchTerm: string = '';
  selectedCategoryId: string = '';
  projects: any[] = []; // Assuming Project is your model/interface for projects
  filteredProjects: any[] = [];
  categories: any[] = [];
  URL = URL_BACKEND;

  constructor(
    public router: Router,
    public homeService: HomeService
  ) { }

  ngOnInit() {
    this.loadProjects();
    this.loadCategories();
  }

  // loadProjects() {
  //   this.homeService.getAllProjects().subscribe(
  //     (data) => {
  //       this.projects = data.data;
  //       this.filteredProjects = this.projects; // Initialize filteredProjects with all projects
  //     },
  //     (error) => {
  //       console.error('Error fetching projects:', error);
  //     }
  //   );
  // }

  loadCategories() {
    this.homeService.getAllCategories().subscribe(
      (data) => {
        this.categories = data.categories;
      },
      (error) => {
        console.error('Error fetching categories:', error);
      }
    );
  }

  loadProjects() {
    this.homeService.getAllProjects().subscribe((data) => {
      this.projects = data.data;
      this.applyFilters(); 
    });
  }

  filterProjects() {
    this.applyFilters();
  }

  clearFilters() {
    this.searchTerm = '';
    this.selectedCategoryId = '';
    this.applyFilters();
  }

  
  applyFilters() {
    this.filteredProjects = this.projects.filter(project => {
      // Check if searchTerm is empty or whitespace
      const isSearchTermEmpty = !this.searchTerm.trim();
  
      // Check if project name matches the searchTerm if searchTerm is not empty
      const titleMatches = isSearchTermEmpty || project.name.toLowerCase().includes(this.searchTerm.toLowerCase());
      
      // Check if project category matches the selected category
      const categoryMatches = !this.selectedCategoryId || project.category.id === this.selectedCategoryId;
  
      // Return true only if either the title matches or the category matches
      return (isSearchTermEmpty || titleMatches) && categoryMatches;
    });
  }
  

}
