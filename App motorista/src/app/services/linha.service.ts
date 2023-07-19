import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { EnderecoService } from './endereco.service';

@Injectable({
  providedIn: 'root'
})
export class LinhaService {

  constructor(
    private http: HttpClient,
    private EnderecoService: EnderecoService
  ) { }

  private URL = this.EnderecoService.endereco+"api/listarlinhasapp?pass=mixbus123api";

  linhas(): Observable<any> {
    return this.http.get<any>(this.URL);
  }
}
