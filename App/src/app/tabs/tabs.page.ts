import { Component } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-tabs',
  templateUrl: 'tabs.page.html',
  styleUrls: ['tabs.page.scss']
})
export class TabsPage {

  constructor(private router: Router) {}

  

  irParaSobre() {
    this.router.navigate(['/sobre']);
  }

  irParaSuporte() {
    this.router.navigate(['/suporte']);
  }

  irParaConfiguracoes() {
    this.router.navigate(['/configuracoes']);
  }

}
