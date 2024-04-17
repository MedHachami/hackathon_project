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

  categories: any[] = [];
  projects: any[] = [];
  filteredProjects: any[] = [];
  searchTerm: string = '';
  selectedCategoryId: number | null = null;
  URL = URL_BACKEND;

  constructor(
    public router: Router,
    public homeService: HomeService
  ) { }

  ngOnInit() {
    this.loadProjects();
    this.loadCategories();
  }

  loadProjects() {
    this.homeService.getAllProjects().subscribe(
      (data) => {
        this.projects = data.data;
        this.filteredProjects = this.projects; // Initialize filteredProjects with all projects
      },
      (error) => {
        console.error('Error fetching projects:', error);
      }
    );
  }

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

  filterProjects() {
    // Apply filters based on search term and selected category
    this.filteredProjects = this.projects.filter(project => {
      const matchSearch = this.searchTerm ? project.name.toLowerCase().includes(this.searchTerm.toLowerCase()) : true;
      const matchCategory = this.selectedCategoryId ? project.category_id === this.selectedCategoryId : true;
      return matchSearch && matchCategory;
    });
  }

  clearFilters() {
    this.searchTerm = '';
    this.selectedCategoryId = null;
    this.filterProjects();
  }

}
