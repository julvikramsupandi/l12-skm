import { useEffect, useState } from "react"
import { Button } from "@/components/ui/button"
import { Progress } from "@/components/ui/progress"
import { Question, Service, Skm } from "@/types"
import {
    RadioGroup,
    RadioGroupItem,
} from "@/components/ui/radio-group"
import { router } from "@inertiajs/react"
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle
} from "@/components/ui/card"
import { ArrowLeft, ArrowRight, SendHorizonalIcon } from "lucide-react"
import { Textarea } from "@/components/ui/textarea"

interface QuestionnaireFormProps {
    skm: Skm,
    service: Service,
    questions: Question[],
    respondentUuid: string,
    respondentName: string,
    respondentGender: string,
}

export default function QuestionnaireForm({ skm, service, questions, respondentUuid, respondentName, respondentGender }: QuestionnaireFormProps) {
    const [step, setStep] = useState(0)
    const [feedback, setFeedback] = useState("")

    type AnswerValue = {
        respondent_uuid: string
        question_id: number
        answer_option_id: number
        score: number
    }

    const [answers, setAnswers] = useState<
        Record<number, AnswerValue>
    >({})


    const currentQuestion = questions[step]
    const total = questions.length + 1
    const progress = Math.round(((step + 1) / total) * 100)

    const handleNext = () => {
        setTimeout(() => {
            if (step < total - 1) setStep(step + 1)
        }, 300);
    }

    const handlePrev = () => {
        if (step > 0) setStep(step - 1)
    }

    const handleSubmit = () => {
        router.post(route('survey.submit'), {
            answers,
            feedback,
        })
    }

    return (
        <Card className='backdrop-blur bg-card/75 border-primary/25 '>
            <CardHeader>
                <CardTitle>
                    {skm.unor.name}
                </CardTitle>
                <CardDescription>
                    <span className="text-primary">{respondentName}</span> | {service.name} | {service.service_channel}
                    <div className="space-y-1 mt-2">
                        <Progress value={progress} className="h-1" />
                        <p className="text-xs text-muted-foreground">
                            Pertanyaan {step + 1} dari {total}
                        </p>
                    </div>
                </CardDescription>
            </CardHeader>
            <CardContent>

                {
                    step < questions.length ? (
                        <>
                            <div className="mb-3 text-lg md:text-xl font-bold">
                                {step + 1}. {currentQuestion.question_text}
                            </div>

                            <RadioGroup
                                key={currentQuestion.id}
                                value={answers[currentQuestion.id]?.answer_option_id?.toString() ?? ""}
                                onValueChange={(value) => {
                                    const selected = currentQuestion.option_scale.answer_options.find(
                                        (o) => o.id.toString() === value
                                    )

                                    if (!selected) return

                                    setAnswers({
                                        ...answers,
                                        [currentQuestion.id]: {
                                            respondent_uuid: respondentUuid,
                                            question_id: currentQuestion.id,
                                            answer_option_id: selected.id,
                                            score: selected.score,
                                        },
                                    })

                                    handleNext();
                                }}
                                className="space-y-3"
                            >
                                <div className='grid grid-cols-2 md:grid-cols-4 gap-4'>

                                    {
                                        currentQuestion.option_scale.answer_options.map((option) => {
                                            const selected =
                                                answers[currentQuestion.id]?.answer_option_id === option.id

                                            const image = '/assets/images/' + respondentGender + '/' + option.score + '.png';

                                            return (
                                                <label
                                                    key={option.id}
                                                    htmlFor={`q${currentQuestion.id}_o${option.id}`}
                                                    className={`justify-items-center items-center gap-4 p-4 rounded-lg border cursor-pointer transition 
                                            ${selected
                                                            ? 'border-primary bg-primary/20'
                                                            : 'border-primary/20 hover:bg-secondary'}
                                        `}
                                                >
                                                    <RadioGroupItem
                                                        value={option.id.toString()}
                                                        id={`q${currentQuestion.id}_o${option.id}`}
                                                        className="hidden"
                                                    />

                                                    <div>
                                                        <img
                                                            src={image}
                                                            alt={option.label}
                                                            className="w-48 object-contain"
                                                        />
                                                    </div>

                                                    <div className="mt-1 text-center">
                                                        <span className=" text-sm md:text-md font-medium">
                                                            {option.label}
                                                        </span>
                                                    </div>
                                                </label>
                                            )
                                        })}
                                </div>
                            </RadioGroup>
                        </>
                    ) : (
                        <>
                            <div className="text-lg md:text-xl font-bold mb-2">
                                Masukan dan Saran
                            </div>

                            <p className="text-sm text-muted-foreground mb-4">
                                Silakan berikan masukan atau saran untuk peningkatan kualitas layanan kami.
                            </p>

                            <Textarea
                                value={feedback}
                                onChange={(e) => setFeedback(e.target.value)}
                                placeholder="Tuliskan masukan dan saran Anda di sini..."
                                className="w-full min-h-[120px] rounded-md border border-primary/30 p-3 focus:outline-none focus:ring-2 focus:ring-primary"
                            />
                        </>
                    )
                }

            </CardContent>
            <CardFooter>

                <div className="flex justify-between w-full">
                    <Button
                        variant="outline"
                        onClick={handlePrev}
                        disabled={step === 0}
                    >
                        <ArrowLeft className="mr-1 h-4 w-4" />
                        Sebelumnya
                    </Button>

                    {step === total - 1 ? (
                        <Button
                            onClick={handleSubmit}
                        >
                            Kirim
                            <SendHorizonalIcon className="mr-1 h-4 w-4" />
                        </Button>
                    ) : (
                        <Button
                            onClick={handleNext}
                            disabled={
                                step < questions.length &&
                                !answers[currentQuestion.id]
                            }
                        >
                            Berikutnya
                            <ArrowRight className="ml-1 h-4 w-4" />
                        </Button>
                    )}
                </div>
            </CardFooter>
        </Card >
    )
}
