import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { EnderecoService } from './endereco.service';


@Injectable({
  providedIn: 'root'
})
export class HorariosService {

  constructor(
    private http: HttpClient,
    private EnderecoService: EnderecoService
  ) { }

  private URL = this.EnderecoService.endereco+"api/listarhorarios?pass=mixbus123api";

  consultarHorarios(dados: any): Observable<any> {
    return this.http.post<any>(this.URL, dados);
  }
}
