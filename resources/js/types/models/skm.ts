import { Unor } from './unor'

export interface Skm {
    id: number
    uuid: string
    unor_id: number
    created_at: string
    updated_at: string
    unor: Unor
}


export interface Respondent {
    id: number,
    uuid: string,
    survey_date: string,
    survey_time: string,
    respondent_name: string,
    age: number,
    gender: 'P' | 'L',
    education: string,
    occupation: string,
    is_disability: boolean,
    disability_type: string,
}