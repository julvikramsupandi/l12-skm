import { Head } from "@inertiajs/react"
import AppLayout from "@/layouts/app-layout"
import QuestionnaireForm from "./components/QuestionnaireForm"
import { Question, Respondent, Service, Skm } from "@/types"

interface QuestionnairePageProps {
    title: string,
    skm: Skm,
    service: Service,
    respondent: Respondent,
    questions: Question[]
}

export default function QuestionnairePage({ title, skm, service, respondent, questions }: QuestionnairePageProps) {
    return (
        <AppLayout>
            <Head title={title} />
            <div className="h-[calc(100vh-240px)] flex flex-col justify-center ">
                <QuestionnaireForm
                    skm={skm}
                    service={service}
                    questions={questions}
                    respondentUuid={respondent.uuid}
                    respondentName={respondent.respondent_name}
                    respondentGender={respondent.gender == 'L' ? 'male' : 'female'}
                />
            </div>
        </AppLayout>
    )
}
