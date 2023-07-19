import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';
import { SobreComponent } from './sobre/sobre.component';
import { SuporteComponent } from './suporte/suporte.component';
import { ConfiguracoesComponent } from './configuracoes/configuracoes.component';
import { Tab3Page } from './tab3/tab3.page';

const routes: Routes = [
  {
    path: '',
    loadChildren: () => import('./tabs/tabs.module').then(m => m.TabsPageModule)
  },
  {
    path: 'Tab3',
    component: Tab3Page
  },
  {
    path: 'sobre',
    component: SobreComponent
  },
  {
    path: 'suporte',
    component: SuporteComponent
  },
  {
    path: 'configuracoes',
    component: ConfiguracoesComponent
  },
];
@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule {}
