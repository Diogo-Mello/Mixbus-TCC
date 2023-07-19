import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { EnderecoService } from './endereco.service';

export interface Motorista{
  id: number
}

export interface MotoristaResponse {
  nome: string;
  empresa: string;
}

@Injectable({
  providedIn: 'root'
})
export class HomeService {

  constructor(
    private http: HttpClient,
    private EnderecoService: EnderecoService
  ) { }

  private URL = this.EnderecoService.endereco+"api/listardadosmotorista?pass=mixbus123api";

  motorista(motorista: Motorista): Observable<MotoristaResponse> {
    return this.http.post<MotoristaResponse>(this.URL, motorista);
  }
}
